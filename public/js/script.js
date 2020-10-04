$(document).ready(function(){
    $('.dropdown-item').on('click', function(){
        // console.log($(this).parent().attr('id'));
        var tipo_video = $(this).parent().attr('id');
        // console.log();

        $.ajax({
            type: 'POST',
            url: '/tipoFilme',
            data: {
                'genero': $(this).attr('id'),
                'tipo': tipo_video
            },
    
            dataType: 'json',
            success: function(dados){
                if(tipo_video == 'series'){
                    var lista = document.getElementById('lista_filmes');
                    lista.style.display = 'none';
                    lista.innerHTML='';
                }else{
                    var lista = document.getElementById('lista_series');
                    lista.style.display = 'none';
                    lista.innerHTML='';
                }

                var lista = document.getElementById('lista_'+tipo_video);
                lista.style.display = 'block';
                lista.innerHTML='';

                for(var i=0;i<dados.length;i+=1){
                    // console.log(dados[i]);
                    var a = document.createElement('a');
                    var titulo = document.createElement('p');
                    var avaliacao = document.createElement('p');
                    var avaliacao_span = document.createElement('span');
                    var avaliacao_i = document.createElement('i');

                    avaliacao_i.className = "fas fa-star";
                    avaliacao.className = "avaliacao";
                    titulo.className = 'titulo';
                    a.className = "coluna_"+tipo_video+" video_"+dados[i]['id'];
                    a.href = "/assistir?tipo="+tipo_video+"&id="+dados[i]['id'];
                    a.style.background = "url(img/"+tipo_video+"/"+dados[i]['poster'];

                    var txt_span = document.createTextNode(dados[i]['avaliacao']);
                    var txt_p = document.createTextNode(dados[i]['titulo']);
                    
                    avaliacao_span.appendChild(txt_span);
                    avaliacao.appendChild(avaliacao_span);
                    avaliacao.appendChild(avaliacao_i);
                    a.appendChild(avaliacao);
                    titulo.appendChild(txt_p);
                    a.appendChild(titulo);
                    lista.appendChild(a);
                }
            },
            error: function(erro){
                console.log('erro: '+erro);
            }
        });
    });

    $('#inp_nav_video').on('keyup', function(){
        $.ajax({
            type: 'POST',
            url: '/pesquisa_video',
            data: {
                'video': $('#inp_nav_video').val()
            },

            dataType: 'json',
            success: function(dados){
                var nav_videos = $('.nav_videos');

                nav_videos.html('');
                
                for(var i=0;i<dados[0].length; i+=1){
                    console.log(dados[0][i]['id']);

                    var nav_video = $("<a href='/assistir?tipo=series&id="+dados[0][i]['id']+"' class='nav_serie'></a>").text(dados[0][i]['titulo']);
                    nav_videos.prepend(nav_video);
                }
                if(dados[0].length >= 1 && dados[1].length >= 1){
                    var hr = $("<hr/ style='margin-top: 0.3rem; margin-bottom: 0.3rem'>");
                    $('.nav_serie:last-child').before(hr);
                }
                for(var i=0;i<dados[1].length; i+=1){
                    var nav_video = $("<a href='/assistir?tipo=filmes&id="+dados[1][i]['id']+"' class='nav_filme'></a>").text(dados[1][i]['titulo']);
                    nav_videos.prepend(nav_video);
                }
            },
            error: function(erro){
                console.log('erro');
            }
        });
    });

    $('.avaliacao_boa, .avaliacao_ruim').on('click', function(){
        var retorno_avaliacao = $(this).attr('class');
        var tipo = $(this).parent().attr('class');

        retorno_avaliacao = retorno_avaliacao.split('_')[1];
        tipo = tipo.split('_')[0];

        if(retorno_avaliacao == 'boa'){
            retorno_avaliacao = 1;
        }else{
            retorno_avaliacao = -1;
        }

        $.ajax({
            type: 'POST',
            url: '/avaliacao_video',
            data: {
                'id': $(this).attr('id'),
                'avaliacao': retorno_avaliacao,
                'tipo': tipo
            },

            dataType: 'json',
            success: function(dados){
                console.log(dados);
                $('.avaliacao').text(dados[0]['avaliacao']);
            },
            error: function(erro){
                console.log('erro');
                console.log(erro);
            }
        });
    });

    $('.filmes_avaliacao button, .series_avaliacao button').on('click', function(){
        $('.avaliacao_boa').fadeOut('0');
        $('.avaliacao_ruim').fadeOut('0');
        
        $('.msg_avaliado').fadeIn('slow');
        $('.avaliacao').css({
            'color': '#20c997',
            'margin-right': '0.5rem',
            'text-align': 'center'
        });
    });
});