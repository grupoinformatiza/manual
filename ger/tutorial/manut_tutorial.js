$(function(){
   $('#filImagem').change(trataArquivo); 
});


function trataArquivo(evt){
    if($('#filImagem').val() != ''){
        
        var arquivo = evt.target.files;
        
        var reader = new FileReader();
        $('.img-preview').removeClass('hidden');
        
        
        reader.onprogress = atualizarProgresso;

        reader.onloadend = function(){ // set image data as background of div
            $('.progress-bar').css('width',100+'%');
            $('.progress-bar-label').text(100 + '%');
            $('.progress').fadeOut('slow');
            $("#preview").attr("src", this.result);
        };
        reader.readAsDataURL(arquivo[0]); // lendo o arquivo local
        
    }
}

function atualizarProgresso(evt){
    if (evt.lengthComputable) {
      var pctProgresso = Math.round((evt.loaded / evt.total) * 100);
      // Increase the progress bar length.
      if (pctProgresso < 100) {
        $('.progress-bar').css('width',pctProgresso+'%');
        $('.progress-bar-label').text(pctProgresso + '%');
      }
    }
}