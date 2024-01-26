<?php

namespace App\Http\Controllers\Admin\Pages\Settings;

use App\Http\Controllers\Controller;
use App\Models\Layout;
use App\Models\Layout_Button;
use App\Models\Layout_carousel_grande;
use Carbon\Carbon;
use FontLib\Table\Type\post;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Helper\Pagination;
use App\Models\UsersHasPoints;




class LayoutController extends Controller
{

    protected $layout;


    public function __construct(Layout $layout)
    {
        $this->layout = $layout;
    }



    public function index(Request $request)
    {

        $layout = Layout::all();


        return view('admin.pages.settings.layout.index', ['layout' => $layout]);
    }

    public function destroy(Request $request, Layout $layout)
    {
        $data = $request->all();
        $id = $data['id'];
        $layout_button = Layout_Button::all();
        $layout_carousel_grande = Layout_carousel_grande::all();
        // Busca o modelo pelo ID
        $layoutCarouselGrande = Layout_carousel_grande::find($id);

        // Verifica se o modelo foi encontrado
        if ($layoutCarouselGrande) {
            // Exclui o modelo
            $layoutCarouselGrande->delete();


        }
    }


    public function edit(Layout $layout)
    {
        $layout_button = Layout_Button::all();
        $layout_carousel_grande = Layout_carousel_grande::all();

        return view('admin.pages.settings.layout.edit', ['layout' => $layout, 'layout_button' => $layout_button, 'layout_carousel_grande' => $layout_carousel_grande]);
    }




    public function update(Request $request, Layout_Button $layout_button, Layout_carousel_grande $layout_carousel_grande)
    {



        $data = $request->all();


        if($data['nome_config'] == "Carousel Grande"){

        $valores = [];
        $datas = [];

        foreach ($data as $key => $value) {
            if (strpos($key, 'img_visivel') !== false) {
                $valor = explode('_', $key)[2];
                $valores[] = $valor;
                $datas[] = $value;
            }
        }

        // Atualiza automaticamente para todos os valores em $valores
        foreach ($valores as $index => $valor) {
            $layout_carousel_grande->where('id', $valor)->update([
                'visivel' => $datas[$index]
            ]);
        }
    }

    if($data['nome_config'] == "Botões"){
    
        // Campos PUT Button 1

        if (isset($request->visivel_btn1)) {
            $layout_button->visivel = $data['visivel_btn1'];
        }

        if (isset($request->first_text_btn1)) {
            $layout_button->first_text = $data['first_text_btn1'];
        }

        if (isset($request->second_text_btn1)) {
            $layout_button->second_text = $data['second_text_btn1'];
        }

        if (isset($request->cor_btn1)) {
            $layout_button->cor = $data['cor_btn1'];
        }

        if (isset($request->link_btn1)) {
            $layout_button->link = $data['link_btn1'];
        }

        $layout_button->where('id', 1)->update([
            'visivel' => $layout_button->visivel,
            'first_text' => $layout_button->first_text,
            'second_text' => $layout_button->second_text,
            'cor' => $layout_button->cor,
            'link' => $layout_button->link,
        ]);

        // Campos PUT Button 2

        if (isset($request->visivel_btn2)) {
            $layout_button->visivel = $data['visivel_btn2'];
        }

        if (isset($request->first_text_btn2)) {
            $layout_button->first_text = $data['first_text_btn2'];
        }

        if (isset($request->second_text_btn2)) {
            $layout_button->second_text = $data['second_text_btn2'];
        }

        if (isset($request->cor_btn2)) {
            $layout_button->cor = $data['cor_btn2'];
        }

        if (isset($request->link_btn2)) {
            $layout_button->link = $data['link_btn2'];
        }

        $layout_button->where('id', 2)->update([
            'visivel' => $layout_button->visivel,
            'first_text' => $layout_button->first_text,
            'second_text' => $layout_button->second_text,
            'cor' => $layout_button->cor,
            'link' => $layout_button->link,
        ]);

    }

        // Save card grande

        if (isset($request->image)) {
            if ($request->file('image')->isValid()) {
                $image = $request->image->store('carousel_grande');
                $data['logo'] = $image;
                $layout_carousel_grande->url = $data['logo'];
                $layout_carousel_grande->nome = $request->nome;
                $layout_carousel_grande->visivel = $request->visivel_btn;
                $layout_carousel_grande->config = $request->nome_config;
                $layout_carousel_grande->save();

            }
        }

        $layout_button = Layout_Button::all();
        $layout_carousel_grande = Layout_carousel_grande::all();

        try {




            return redirect()->back()->withErrors([
                'success' => 'Configuração alterada com sucesso!'
            ]);
        } catch (\Exception $exception) {

            return redirect()->route('admin.settings.layout.index')->withErrors([
                'error' => config('app.env') != 'production' ? $exception->getMessage() : 'Ocorreu um erro ao cadastrar a imagem, tente novamente'
            ]);
        }




    }



}