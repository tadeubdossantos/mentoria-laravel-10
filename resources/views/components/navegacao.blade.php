<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
        <svg class="bi"><use xlink:href="#house-fill"/></svg>
        Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('venda.index')}}">
        <svg class="bi"><use xlink:href="#file-earmark"/></svg>
        Venda
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('produto.index'); }}">
        <svg class="bi"><use xlink:href="#cart"/></svg>
        Produto
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('cliente.index'); }}">
        <svg class="bi"><use xlink:href="#people"/></svg>
        Clientes
        </a>
    </li>
</ul>