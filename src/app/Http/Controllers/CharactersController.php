<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharactersController extends Controller
{
	private $pager=10;
	public function show(){
		$page=isset($_REQUEST["page"])?$_REQUEST["page"]:0;
		$count=\DB::table("characters")->count();
		$pages=ceil($count/$this->pager);
		$next="http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		$prev="http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		if($page<$pages){
			$_=explode("=",$next);
			$next=$_[0]."=".++$_[1];
		}else{
			$next=null;
		}
		if($page>1){
			$_=explode("=",$prev);
			$prev=$_[0]."=".--$_[1];
		}else{
			$prev=null;
		}
		$info=array('count'=>$count,'pages'=>$pages,'next'=>$next,'prev'=>$prev);
		$resultsData=\DB::table("characters")->get();
		$results=array();
		unset($_);
		foreach ($resultsData as $character){
			$_["id"]=$character->id;
			$_["name"]=$character->name;
			$_["status"]=$character->status;
			$_["species"]=$character->species;
			$_["type"]=$character->type;
			$_["gender"]=$character->gender;
			$_["origin"]=json_decode($character->origin);
			$_["location"]=json_decode($character->location);
			$_["image"]=$character->image;
			$_["episode"]=json_decode($character->episode);
			$_["url"]=$character->url;
			$_["created"]=$character->created;
			$results[]=$_;
		}
		$data=array('info'=>$info,'results'=>$results);
		return response()->json($data);
	} 
	public function create(Request $request){
		$request->validate([
			'name' => [
				'required', 
				'between:4,30'
			],
			'status' => [
				'required',
				'in:Alive,unknown,Dead'
			],
			'species' => [
				'required',
				'in:Human,Alien,Robot,Planet,Mythological Creature,Humanoid'
			],
			'type' => [
				'string'
			],
			'gender' => [
				'required',
				'in:Male,Female.unknown,Genderless'
			],
			'origin' => [
				'required',
				'json',
			],
			'location' => [
				'required',
				'json',
			],
			'image' => [
				'required',
				'url',
			],
			'episode' => [
				'required',
				'json',
			],
			'url' => [
				'required',
				'url',
			]
		]);
		$id=\DB::table("characters")->insertGetId($request->only([
			'name','status','species','type','gender','origin','location','image','episode','url'
		]));
		$data=array('status'=>'success','msg'=>'Registro insertado correctamente','id'=>$id);
		return response()->json($data);
	} 
	public function read($id){
		$resultsData=\DB::table("characters")->where('id',$id)->get();
		$results=array();
		foreach ($resultsData as $character){
			$_["id"]=$character->id;
			$_["name"]=$character->name;
			$_["status"]=$character->status;
			$_["species"]=$character->species;
			$_["type"]=$character->type;
			$_["gender"]=$character->gender;
			$_["origin"]=json_decode($character->origin);
			$_["location"]=json_decode($character->location);
			$_["image"]=$character->image;
			$_["episode"]=json_decode($character->episode);
			$_["url"]=$character->url;
			$_["created"]=$character->created;
			$result=$_;
		}
		return response()->json($result);
	} 
	public function update(Request $request, $id){
		$request->validate([
			'name' => [
				'required', 
				'between:4,30'
			],
			'status' => [
				'required',
				'in:Alive,unknown,Dead'
			],
			'species' => [
				'required',
				'in:Human,Alien,Robot,Planet,Mythological Creature,Humanoid'
			],
			'type' => [
				'string'
			],
			'gender' => [
				'required',
				'in:Male,Female.unknown,Genderless'
			],
			'origin' => [
				'required',
				'json',
			],
			'location' => [
				'required',
				'json',
			],
			'image' => [
				'required',
				'url',
			],
			'episode' => [
				'required',
				'json',
			],
			'url' => [
				'required',
				'url',
			]
		]);
		$data=\DB::table("characters")->where('id',$id)->update($request->only([
			'name','status','species','type','gender','origin','location','image','episode','url'
		]));
		$msg=$data?'Registro actualizado correctamente':'Registro no se ha encontrado en la base de datos';
		$status=$data?'success':'error';
		$data=array('status'=>$status,'msg'=>$msg,'id'=>$id);
		return response()->json($data);
	} 
	public function delete($id){
		$data=\DB::table("characters")->where('id',$id)->delete();
		$msg=$data?'Registro eliminado correctamente':'Registro no se ha encontrado en la base de datos';
		$status=$data?'success':'error';
		$data=array('status'=>$status,'msg'=>$msg,'id'=>$id);
		return response()->json($data);
	} 
}
