function deleteRegistroPaginacao(rotaUrl, idREgistro){
    if(confirm('Deseja confirmar a exclusão?')){
        $.ajax({
            url: rotaUrl,
            method: 'DELETE',
            header: {},
            data: {
                id: idREgistro,
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
        }).fail(function (data){
            $.unblockUI();
            alert('Não foi possivel excluir os dados');
        });
    }
}