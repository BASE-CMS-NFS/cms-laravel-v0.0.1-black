@extends('template.content')
@section('content')


    <div class="row">
        <div class="col-sm-12">
            
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{$title}}</h4>
                    <div class="mt-10">
                        <ul>
                            <li>Bandung Desember 2022</li>
                            <li>By nfs <a href="https://github.com/nifist99">https://github.com/nifist99</a></li>
                            <li>Black Template</li>
                            <li>Cms version 0.0.1</li>
                            <li>Requirement php 7.4 - 8.1</li>
                            <li>Laravel 8/9</li>
                        </ul>
                    </div>
                    <div class="mt-10">
                        <p>Cara instalasi di local komputer</p>
                        <ul>
                            <li>composer update</li>
                            <li>php artisan migrate</li>
                            <li>php artisan passport:install --uuids</li>
                            <li>php artisan db:seed</li>
                            <li>php artisan storage:link</li>
                            <li>php artisan optimize:clear</li>
                        </ul>
                    </div>

                    <div class="mt-10">
                        <p>Cara instalasi di vps atau hosting</p>
                        <ul>
                            <li>composer update</li>
                            <li>php artisan migrate</li>
                            <li>php artisan passport:install --uuids</li>
                            <li>php artisan db:seed</li>
                            <li>php artisan storage:link</li>
                            <li>php artisan optimize:clear</li>
                        </ul>
                    </div>

                  </div>
                </div>
        </div>
    </div>

@endsection