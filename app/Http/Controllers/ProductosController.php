<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use App\Models\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductosController extends Controller
{
    public function show()
    {
        $producto = producto::orderBy('id','DESC')->get();

        if (isset($producto)) {
            return response()->json(["status" => true, "producto" => $producto]);
        }
        return response()->json(["status" => false, "message" => "no hay producto"]);
    }
    public function storage(Request $request)
    {
       $validator=Validator::make($request->all(),[
           'nombre'=>'required',
           'categoria'=>'required',
           'descripcion'=>'required',
           'precio'=>'required',
           'inventario'=>'required',
           'fileSource'=>'required'
       ]);
       if($validator->fails()) {
           return response()->json(['status'=>false,"message"=> $validator->errors()],200);
       }

        $imageName = $this->randoImageName();

        $fullPath = public_path('/storage/productoImagen/' . $imageName);

        $image = $request->fileSource;
        $imageContent = $this->imageBase64Content($image);

        $imgUpload =  File::put($fullPath, $imageContent);

        if (isset($imgUpload)) {
            $prductos = new producto();
            $prductos->nombre = $request['nombre'];
            $prductos->categoria = $request['categoria'];
            $prductos->descripcion = $request['descripcion'];
            $prductos->precio = $request['precio'];
            $prductos->inventario = $request['inventario'];
            $prductos->img = 'http://127.0.0.1:8000/storage/productoImagen/' . $imageName;
            if ($prductos->save()) {
                return  response()->json(["status" => true, "producto" => $prductos], 200);
            }
        } else {
            return response()->json(["status" => false, 'message' => "no se pudo subir la imagen"]);
        }
        return response()->json(["status" => false, "message" => "hubo un error intente de nuevo"], 200,);
    }

    public function delete($id)
    {
        $producto =  producto::find($id);
        $imgName = str_replace('http://127.0.0.1:8000/storage/', 'public/', $producto->img);
        Storage::delete($imgName);
        $producto->delete();
    }

    public function update(Request $request, $id)
    {
        $producto = producto::find($id);
        if (empty(!$request->fileSource)) {
            $imgName = str_replace('http://127.0.0.1:8000/storage/', 'public/', $producto->img);
            $imgUpload =  Storage::delete($imgName);
            if ($imgUpload) {
                $imageName = $this->randoImageName();

                $fullPath = public_path('/storage/productoImagen/' . $imageName);

                $image = $request->fileSource;
                $imageContent = $this->imageBase64Content($image);
                $imgUpload =  File::put($fullPath, $imageContent);
                $producto->img = 'http://127.0.0.1:8000/storage/productoImagen/' . $imageName;
            }
        }
        $producto->nombre = $request['nombre'];
        $producto->categoria = $request['categoria'];
        $producto->descripcion = $request['descripcion'];
        $producto->precio = $request['precio'];
        $producto->inventario = $request['inventario'];
        $producto->update();


        return response()->json($producto);
    }

   public function categoria(){
    return response()->json(categoria::all());   
   }


    public function randoImageName()
    {
        return Str::random(10) . '.' . 'jpg';
    }

    private function imageBase64Content($image)
    {
        $remplazar = array("data:image/png;base64,", "data:image/jpeg;base64,");
        $image = str_replace($remplazar, '', $image);
        $image = str_replace(' ', '+', $image);
        return base64_decode($image);
    }
}
