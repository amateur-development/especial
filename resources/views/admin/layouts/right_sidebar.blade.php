<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html"><i class="icon-speedometer"></i> Dashboard <span class="badge badge-info">NEW</span></a>
            </li>

            <li class="nav-title">
                Node Tree
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.users.lists')}}"><i class="icon-ghost"></i> Users</a>
            </li>
            @if($menuFirstNode)
                @foreach($menuNodes->where('parent_id',$menuFirstNode['id'])->where('is_show',1)->sortBy('sort') as $node)
                    @if(!$adminNodes->contains($node->id))
                        @continue
                    @endif
                    @if(!$node['is_dir'])
                        <li class="nav-item @if($menuCurrentNode && $menuCurrentNode->inTree($node['id'])) open @endif">
                            <a class="nav-link @if($menuCurrentNode && $menuCurrentNode->inTree($node['id'])) active @endif" href="{{try_route($node['route'])}}" data-id="{{$node['id']}}">
                                <i class="{{$node['ico'] ?: 'icon-menu'}}"></i> {{$node['title']}}
                            </a>
                        </li>
                    @else
                        <li class="nav-item nav-dropdown @if($menuCurrentNode && $menuCurrentNode->inTree($node['id'])) open @endif">
                            <a class="nav-link nav-dropdown-toggle" href="javascript:;" data-id="{{$node['id']}}"><i class="{{$node['ico'] ?: 'icon-list'}}"></i> {{$node['title']}}</a>
                            <ul class="nav-dropdown-items">
                                @foreach($menuNodes->where('parent_id',$node['id'])->where('is_show',1)->sortBy('sort') as $subNode)
                                    <li class="nav-item @if($menuCurrentNode && $menuCurrentNode->inTree($node['id'])) open @endif">
                                        <a class="nav-link @if($menuCurrentNode && $menuCurrentNode->inTree($node['id'])) active @endif" href="{{try_route($subNode['route'])}}" data-id="{{$subNode['id']}}">
                                            <i class="icon-puzzle"></i> {{$subNode['title']}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            @endif
            <li class="divider"></li>

        </ul>
    </nav>
</div>