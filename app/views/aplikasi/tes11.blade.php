<html>
    <body>
        {{Form::open(array('methode'=>'POST','action'=>array('ProposalController@tes')))}}
            {{Form::label('tes','Nama')}}
            {{Form::text('name',null)}}
            {{Form::submit('Kirim')}}
        {{Form::close()}}
    </body>
    
</html>
    
    