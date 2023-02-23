<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowUserPosts extends Component {
    use WithPagination;
    use WithFileUploads;
    public string $buscar = "", $campo = "id", $orden = "asc";
    public bool $openDetalle = false;
    public bool $openEditar = false;
    public Post $post;
    public $imagen;

    public function render() {
        $categorias = [
            'Comida' => 'Comida',
            'Musica' => 'Musica',
            'Gimnasio' => 'Gimnasio',
            'Informatica' => 'Informatica',
            'Videojuegos' => 'Videojuegos',
            'Programacion' => 'Programacion'
        ];
        $posts = Post::where('user_id', auth()->user()->id)
            ->where(function ($query) {
                $query->where('titulo', 'like', "%{$this->buscar}%")
                    ->orwhere('descripcion', 'like', "%{$this->buscar}%");
            })->orderBy($this->campo, $this->orden)->paginate(4);
        return view('livewire.show-user-posts', compact('posts','categorias'));
    }
    public function updatingBuscar() {
        $this->resetPage();
    }
    public function ordenar(string $campo) {
        $this->orden = ($this->orden == 'asc') ? 'desc' : 'asc';
        $this->campo = $campo;
    }
    public function borrar(Post $post) {
        Storage::delete($post->imagen);
        $post->delete();
        $this->emit('mensaje', 'Post Borrado');
    }
    public function detalle(Post $post) {
        $this->post = $post;
        $this->openDetalle = true;
    }
    public function editar(Post $post) {
        $this->post = $post;
        $this->openEditar = true;
    }
    protected $listeners = [
        'refrescar' => 'render',
    ];
    public function mount() {
        $this->post = new Post;
    }
    public function cancelar() {
        $this->reset('openEditar', 'imagen');
    }
    protected $rules = [
        'post.titulo' => '',
        'post.descripcion' => ['required', 'string', 'min:10'],
            'post.estado' => ['required', 'in:Publicado,Borrador'],
            'post.categoria' => ['required', 'in:Comida,Musica,Gimnasio,Informatica,Videojuegos,Programacion'],
            'post.precio' => ['required', 'numeric', 'min:1', 'max:999'],
            'post.imagen' => ['nullable', 'image', 'max:2048']
    ];
    public function update(){
        $this->validate([
            'post.titulo' => ['required', 'string', 'min:3', 'unique:posts,titulo,'.$this->post->id]
        ]);
        // si he subido una imagen borro la vieja y guardo la nueva.
        if($this->imagen){
            Storage::delete($this->post->imagen);
            $ruta=$this->imagen->store('posts');
            $this->post->imagen=$ruta;
        }
        $this->post->save();
        $this->cancelar();
        $this->emit('mensaje', 'Post actualizado');
    }
}