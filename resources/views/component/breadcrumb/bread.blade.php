<div class="flex items-center flex-wrap text-sm py-2">
  <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">     
  <li class="inline-flex items-center">
    @if($title == 'Ganti Penyimpanan')
    <a href="{{ $breadcrumb['url'] }}" class="flex items-center truncate max-w-[12rem] lg:max-w-max text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500">
      {{ $breadcrumb['label'] == 'parent' ? 'Dashboard' : $breadcrumb['label'] }}
    </a>
    @elseif($title == 'Guest')
    <a href="{{ $breadcrumb['url'] }}" class="flex items-center truncate max-w-[12rem] lg:max-w-max text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500">
      {{ $breadcrumb['label'] }}
    </a>
    @else
    <a href="{{ $breadcrumb['label'] == 'parent' ? '/' : $breadcrumb['url'] }}" class="flex items-center truncate max-w-[12rem] lg:max-w-max text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:focus:text-blue-500">
      {{ $breadcrumb['label'] == 'parent' ? 'Dashboard' : $breadcrumb['label'] }}
    </a>
    @endif
    <svg class="flex-shrink-0 size-5 text-gray-400 dark:text-gray-600 mx-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path d="M6 13L10 3" stroke="currentColor" stroke-linecap="round"/>
    </svg>
  </li>
    @if($title == 'Guest')
    <li class="inline-flex items-center truncate max-w-[12rem] lg:max-w-max text-sm font-semibold text-gray-800 dark:text-gray-200" aria-current="page">
      {{ $folder->title }}
    </li>
    @else
      <li class="inline-flex items-center truncate max-w-[12rem] lg:max-w-max text-sm font-semibold text-gray-800 dark:text-gray-200" aria-current="page">
          {{ $title == 'Ganti Penyimpanan' ? $parent->title : $title }}
      </li>
    @endif
  </ol>
</div>
