import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'home',
    pathMatch: 'full'
  },
  {
    path: 'home',
    loadChildren: './home/home.module#HomePageModule'
  },
  {
    path: 'list',
    loadChildren: './list/list.module#ListPageModule'
  },
  { path: 'list-produtos', loadChildren: './pages/list-produtos/list-produtos.module#ListProdutosPageModule' },
  { path: 'list-usuarios', loadChildren: './pages/list-usuarios/list-usuarios.module#ListUsuariosPageModule' },
  { path: 'cadastro-produtos', loadChildren: './pages/cadastro-produtos/cadastro-produtos.module#CadastroProdutosPageModule' },
  { path: 'cadastro-usuarios', loadChildren: './pages/cadastro-usuarios/cadastro-usuarios.module#CadastroUsuariosPageModule' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
