<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      @foreach(Config::get('admin.menu') as $key => $item)
        @if(!(
          (empty($item['permission']) && empty($item['role']))
          || (!empty($item['permission']) && Auth::user()->can($item['permission']))
          || (!empty($item['role']) && Auth::user()->hasRole($item['role']))
        ))
          @continue
        @endif

        <li class="header">{{ $key }}</li>

        @if(isset($item['menu']) && !empty($item['menu']))
          @foreach($item['menu'] as $key1 => $item1)
            @if(!(
              (empty($item1['permission']) && empty($item1['role']))
              || (!empty($item1['permission']) && Auth::user()->can($item1['permission']))
              || (!empty($item1['role']) && Auth::user()->hasRole($item1['role']))
            ))
              @continue
            @endif

            @if(isset($item1['sub_menu']) && !empty($item1['sub_menu']))
              <li class="treeview">
                <a href="#">
                  <i class="{{ $item1['icon'] }}"></i>
                  <span>{{ $key1 }}</span>
                  <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                </a>

                <ul class="treeview-menu">
                  @foreach($item1['sub_menu'] as $key2 => $item2)
                    @if(!(
                      (empty($item2['permission']) && empty($item2['role']))
                      || (!empty($item2['permission']) && Auth::user()->can($item2['permission']))
                      || (!empty($item2['role']) && Auth::user()->hasRole($item2['role']))
                    ))
                      @continue
                    @endif
                    <li>
                      <a href="{{ url($item2['url']) }}">
                        <i class="fa fa-circle-o"></i>{{ $key2 }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              </li>
            @else
              <li>
                <a href="{{ url($item1['url']) }}">
                  <i class="{{ $item1['icon'] }}"></i>
                  <span>{{ $key1 }}</span>
                </a>
              </li>
            @endif

          @endforeach
        @endif
      @endforeach

      <li class="header">其它</li>
      <li>
        <a href="{{ route('admin.profile') }}">
          <i class="fa fa-user text-info"></i>
          <span>我的资料</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.logout') }}">
          <i class="fa fa-sign-out text-red"></i>
          <span>退出</span>
        </a>
      </li>
    </ul>
  </section>
</aside>
