<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();  // Récupérer les rôles et leurs permissions
        $permissions = Permission::all();  // Récupérer toutes les permissions
        
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::create(['name' => strtoupper($request->name)]);
        
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.roles')->with('success', 'Rôle créé avec succès.');
    }

    /**
     * Display the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        
        return view('admin.roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::findOrFail($id);
        $role->name = strtoupper($request->name);
        $role->save();
        
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->permissions()->detach();
        }

        return redirect()->route('admin.roles')->with('success', 'Rôle mis à jour avec succès.');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        
        // Prevent deletion of core roles
        if (in_array($role->name, ['SUPER_ADMIN'])) {
            return redirect()->back()->with('error', 'Ce rôle système ne peut pas être supprimé.');
        }
        
        $role->delete();
        
        return redirect()->route('admin.roles')->with('success', 'Rôle supprimé avec succès.');
    }

    /**
     * Assign all permissions to the SUPER_ADMIN role.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignPermissionsToSuperRole()
    {
        // Trouver le rôle SUPER_ADMIN
        $role = \Spatie\Permission\Models\Role::findByName('SUPER_ADMIN');
    
        // Récupérer toutes les permissions disponibles
        $permissions = \Spatie\Permission\Models\Permission::all();
    
        // Associer toutes les permissions au rôle
        $role->syncPermissions($permissions);
    
        // Retourner un message de succès
        return redirect()->route('admin.roles')->with('success', 'Les permissions ont été assignées au rôle SUPER_ADMIN avec succès.');
    }
    
}
