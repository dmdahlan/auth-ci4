<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Adminrole extends BaseController
{
	public function index()
	{
		$data = [
			'title'         => 'Admin | Role',
			'role'          => $this->adminrole->findAll(),
			'validation'    => \Config\Services::validation()
		];

		return view('admin/vw_adminrole', $data);
	}
	public function save()
	{
		$request = service('request');
		if (!$this->validate([
			'name' => [
				'rules' => 'required|is_unique[auth_groups.name]',
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah Ada'
				]
			],
			'description' => [
				'rules' => 'required|is_unique[auth_groups.description]',
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah Ada'
				]
			]

		])) {
			session()->setFlashdata('gagal', 'data');
			return redirect()->route('adminrole')->withInput();
		}
		$this->adminrole->save([
			'name'                  => $request->getPost('name'),
			'description'           => $request->getPost('description')

		]);
		session()->setFlashdata('suksesinput', 'Data berhasil Ditambahkan !');
		return redirect()->route('adminrole');
	}
	public function edit($id = 0)
	{
		echo json_encode($this->adminrole->find($id));
	}
	public function update()
	{
		$request = service('request');
		if (!$this->validate([
			'name' => [
				'rules' => 'required|is_unique[auth_groups.name,id,{id}]',
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah Ada'
				]
			],
			'description' => [
				'rules' => 'required|is_unique[auth_groups.description,id,{id}]',
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah Ada'
				]
			]

		])) {
			session()->setFlashdata('gagal', 'data');
			return redirect()->route('adminrole')->withInput();
		}
		$this->adminrole->save([
			'id'                    => $request->getPost('id'),
			'name'                  => $request->getPost('name'),
			'description'           => $request->getPost('description')

		]);
		session()->setFlashdata('ubahdata', 'Data');
		return redirect()->route('adminrole');
	}
	public function delete($id)
	{
		$this->adminrole->delete($id);
		return redirect()->route('adminrole');
	}
	public function roleAccess($role_id)
	{
		$data = [
			'title'         => 'Akses | Role',
			'role'          => $this->db->table('auth_groups')->getWhere(['id' => $role_id])->getRowArray(),
			'menu'          => $this->adminmenu->getViMenu()->getResultArray()
		];
		return view('admin/vw-role-access', $data);
	}
	public function getRole()
	{
		$data = $this->adminrole->getRole();
		echo json_encode($data);
	}
	public function changeAccess()
	{
		$request = service('request');
		$menu_id = $request->getPost('menuId');
		$role_id = $request->getPost('roleId');

		$data = [

			'group_id' => $role_id,
			'permission_id' => $menu_id
		];

		$result = $this->db->table('auth_groups_permissions')->getWhere($data);
		if ($result->getRowArray() < 1) {
			$this->db->table('auth_groups_permissions')->insert($data);
		} else {
			$this->db->table('auth_groups_permissions')->delete($data);
		}
		// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Akses Berhasil dirubah</div>');
	}
}
