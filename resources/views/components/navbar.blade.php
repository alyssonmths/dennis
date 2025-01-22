<style>
  ul.nav {
    border-bottom: 1px solid black;
    /* border-radius: 0px 0px 20px 20px; */
    padding: 5px;
  }

  a.nav-link {
      padding: 10px 20px;
      border: unset;
      border-radius: 15px;
      color: #212121;
      z-index: 1;
      background: #ffffff;
      position: relative;
      font-weight: 700;
      font-size: 17px;
      /* box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.103); */
      transition: all 250ms;
      overflow: hidden;
      margin: 5px;
  }

  a.nav-link.active {
      background-color: #2b95eb;
      color: white;
      box-shadow: 1px 1px 0px 1px black;
  }
    
  a.nav-link::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 0;
  border-radius: 15px;
  background-color: #2b95eb;
  z-index: -1;
  box-shadow: 4px 8px 19px -3px rgba(0,0,0,0.27);
  transition: all 250ms
  }

  a.nav-link:hover {
  color: #e8e8e8;
  }

  a.nav-link:hover::before {
  width: 100%;
  }

  .dropdown-menu {
    width: fit-content !important;
    padding-right: 10px;
  }
</style>

<ul class="nav justify-content-center align-items-center">
    <a class="navbar-brand" href="/">
      <img src="/images/logo_dennis.png" width="100px" class="me-3">
    </a>
    <li class="nav-item">
      <a id="index" class="nav-link" aria-current="page" href="/">Dashboard</a>
    </li>
    {{-- <li class="nav-item">
        <a id="calculos" class="nav-link" href="{{route('calculos')}}">Cálculos</a>
    </li> --}}
    <a id="calculos" class="dropdown-toggle nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Cálculos
    </a>
    <ul class="dropdown-menu">
      <li><a id="novo" class="dropdown-item nav-link" href="{{route('calculos.novo')}}">Novo</a></li>
      <li><a id="listar" class="dropdown-item nav-link" href="{{route('calculos.listar')}}">Listar</a></li>
    </ul>
    <li class="nav-item">
      <a id="precos" class="nav-link" href="{{route('item.precos')}}">Tabela de preços</a>
    </li>
    {{-- <li class="nav-item">
      <a id="pagamentos" class="nav-link" href="{{route('pagamentos')}}">Pagamentos</a>
    </li> --}}
    <li class="nav-item">
      <a id="estatisticas" class="nav-link" href="{{route('estatisticas')}}">Estatísticas</a>
    </li>
    <li class="nav-item">
        <a id="funcionarios" class="nav-link" href="{{route('funcionarios')}}">Funcionários</a>
    </li>
</ul>