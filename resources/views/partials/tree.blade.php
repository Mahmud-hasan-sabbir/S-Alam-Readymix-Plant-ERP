@foreach ($treeData as $coa)
    <li data-type="{{ count($coa->children) ? 'folder' : ''}}" class="{{ count($coa->children) ? '' : 'fa fa-folder-o d-block'}}">
        <a href="#" style="margin-left:20px" id="childassets" onclick="showForm()" data-id="{{ $coa->id }}"> {{ $coa->HeadName }} </a>
        @if (count($coa->children) > 0)
            <ul>
                @include('partials.tree', ['treeData' => $coa->children])
            </ul>
        @endif
    </li>
@endforeach

