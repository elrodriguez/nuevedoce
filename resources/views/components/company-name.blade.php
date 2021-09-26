
@if($company)
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ $company->name }}</a></li>
@else
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">SmartAdmin</a></li>
@endif