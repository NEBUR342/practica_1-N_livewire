<?php
namespace App\Http\Livewire;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
class CreatePost extends Component {
    use WithFileUploads;
    public bool $openCrear = false;
    public $imagen, $titulo, $descripcion, $categoria, $precio, $estado;
    private static $categorias = [
        'Comida' => 'Comida',
        'Musica' => 'Musica',
        'Gimnasio' => 'Gimnasio',
        'Informatica' => 'Informatica',
        'Videojuegos' => 'Videojuegos',
        'Programacion' => 'Programacion'
    ];
    protected $rules = [
        'titulo' => ['required', 'string', 'min:3', 'unique:posts,titulo'],
        'descripcion' => ['required', 'string', 'min:10'],
        'estado' => ['required', 'in:Publicado,Borrador'],
        'categoria' => ['required', 'in:Comida,Musica,Gimnasio,Informatica,Videojuegos,Programacion'],
        'precio' => ['required', 'numeric', 'min:1', 'max:999'],
        'imagen' => ['required', 'image', 'max:2048']
    ];
    public function render()
    {
        $categorias = self::$categorias;
        return view('livewire.create-post', compact('categorias'));
    }
    public function cancelar()
    {
        $this->reset('openCrear', 'titulo', 'descripcion', 'categoria', 'precio', 'estado', 'imagen');
    }
    public function guardar()
    {
        $this->validate();
        $ruta = $this->imagen->store('posts');
        Post::create([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'estado' => $this->estado,
            'categoria' => $this->categoria,
            'precio' => $this->precio,
            'imagen' => $ruta,
            'user_id' => auth()->user()->id
        ]);
        $this->cancelar();
        $this->emit('mensaje', 'Post Creado');
        $this->emitTo('show-user-posts', 'refrescar');
    }
}
