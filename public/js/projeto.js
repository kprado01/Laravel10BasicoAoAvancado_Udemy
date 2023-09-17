function deleteRegistroPaginacao(rotaUrl, idRegistro){
    if(confirm('Deseja confirmar a exclusão?')){
        console.log($('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            url: rotaUrl,
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            data: {
                id: idRegistro,
            },
            beforeSend: function (){
                $.blockUI({
                    message: 'Carregando',
                    timeout: 2000,
                });
            },
        }).done(function (data){
            $.unblockUI();
            console.log(data);
            if(data.success){
                window.location.reload();
            }
            else
            {
                alert('Não foi possivel excluir');
            }
        }).fail(function (data){
            $.unblockUI();
            alert('Não foi possivel excluir os dados');
        });
    }
}

$(document).ready(function() {
    $('#mascara_valor').mask('000.000.000,00', {reverse: true});
});