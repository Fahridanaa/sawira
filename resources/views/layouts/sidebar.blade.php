@php
    $navItems = array(
		"Demo" => [
			    ['path' => 'material-dashboard/examples/typography.html', 'icon' => 'library_books', 'label' => 'Typography'],
                ['path' => 'material-dashboard/examples/icons.html', 'icon' => 'bubble_chart', 'label' => 'Icons'],
                ['path' => 'material-dashboard/examples/map.html', 'icon' => 'location_ons', 'label' => 'Maps'],
            ],
		"RT" => [
            ['path' => 'dashboard', 'icon' => 'dashboard', 'label' => 'Dashboard'],
//            ['path' => 'user', 'icon' => 'person', 'label' => 'User Profile'],
            ['path' => 'penduduk', 'icon' => 'people', 'label' => 'Kelola Data Penduduk'],
            ['path' => 'riwayat', 'icon' => 'history', 'label' => 'Riwayat Penduduk'],
            ['path' => 'pengajuan', 'icon' => 'content_paste', 'label' => 'Pengajuan mustahik'],
//            ['path' => 'notification', 'icon' => 'notifications', 'label' => 'Notifications']
        ]
    )
@endphp
<div class="logo">
    <span class="simple-text logo-normal text-">
        Sawira
    </span>

</div>
<div class="sidebar-wrapper ps-container ps-theme-default"
     data-ps-id="76eb4fdc-898d-e46f-5f25-5b02c8d32774">
    <ul class="nav">
        @foreach($navItems["RT"] as $item)
            <li class="nav-item {{ (url()->current() === url($item['path'])) ? 'active' : '' }}">
                <x-sidebar-item :path="$item['path']"
                                :icon="$item['icon']"
                                :label="$item['label']"></x-sidebar-item>
            </li>
        @endforeach
        <li class="nav-item active-pro">
            <x-sidebar-item :path="'login'"
                            :icon="'exit_to_app'"
                            :label="'Keluar'"></x-sidebar-item>
        </li>
    </ul>
    <div class="ps-scrollbar-x-rail"
         style="left: 0; bottom: 0;">
        <div class="ps-scrollbar-x"
             tabindex="0"
             style="left: 0; width: 0;"></div>
    </div>
    <div class="ps-scrollbar-y-rail"
         style="top: 0; right: 0;">
        <div class="ps-scrollbar-y"
             tabindex="0"
             style="top: 0; height: 0;"></div>
    </div>
</div>
<div class="sidebar-background"
     style="background-image: {{ asset('material-dashboard/assets/img/sidebar-1.jpg') }}"></div>