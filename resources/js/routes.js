//Generales
const Home = ()=> import('./components/Home.vue');
const Contacto = ()=> import('./components/Contacto.vue');

//Componentes para categorias
const Listar = ()=> import('./components/categorias/Listar.vue');
const Crear = ()=> import('./components/categorias/Crear.vue');
const Editar = ()=> import('./components/categorias/Editar.vue');

export const routes = [
  {
    name:'home',
    path:'/',
    component:Home
  },
  {
    name:'contacto',
    path:'/contacto',
    component:Contacto
  },
  {
    name:'listarCategorias',
    path:'/categorias',
    component:Listar
  },
  {
    name:'crearCategoria',
    path:'/crear',
    component:Crear
  },
  {
    name:'editarCategoria',
    path:'/editar/:id',
    component:Editar
  }
];