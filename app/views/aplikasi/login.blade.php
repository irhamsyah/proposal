<html>
    <head>
    <h1>Form Login</h1>
    </head>
    <body>
        {{ Form::open(array('url'=>'aplikasi')) }}
           {{ Form::label('name','Nama') }}
           {{ Form::text('nama',null) }}
           {{ Form::submit('Submit') }}
        {{ Form::close() }}
        
    </body>
</html>