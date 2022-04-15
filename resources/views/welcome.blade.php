@extends('client.layouts.default')

@section('content')
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="col-md-12">
    
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <table>

                <tr>
                    @isset($details)
                    <h1>Sistem'e Giriş Bilgileri</h1>
                    <p>Email:{{$details['email']}}</p>
                    <p>Şifre:{{$details['password']}}</p>
                    @endisset
                    
                </tr>
            </table>

        </div>

    </div>

</div>
@endsection