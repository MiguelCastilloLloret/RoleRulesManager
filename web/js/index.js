$(document).ready(function(){
	if($("#form_game").val()==="DD35"){
		$("#form_CD").parent().addClass("oculto");
		$("#form_pj2").parent().addClass("oculto");
		$("#form_spell").parent().addClass("oculto");
		$("#form_skill").parent().addClass("oculto");
		$("#form_action").change(function(){
			$("#form_CD").parent().addClass("oculto");
			$("#form_pj2").parent().addClass("oculto");
			$("#form_spell").parent().addClass("oculto");
			$("#form_skill").parent().addClass("oculto");
			if($("#form_action").val()!="AutoHechizo" && $("#form_action").val()!="TiradaDificultad"){
				$("#form_pj2").parent().removeClass("oculto");
				if($("#form_action").val()==="TiradaEnfrentada"){
					$("#form_skill").parent().removeClass("oculto");
				}
				if($("#form_action").val()==="HechizoObjetivo"){
					$("#form_spell").parent().removeClass("oculto");
				}
			}else if($("#form_action").val()==="TiradaDificultad"){
				$("#form_skill").parent().removeClass("oculto");
				$("#form_CD").parent().removeClass("oculto");
			}else{
				$("#form_spell").parent().removeClass("oculto");
			}
		});
	}
	if($("#form_game").val()==="Vampiro"){
		$("#form_CD").parent().addClass("oculto");
		$("#form_pj2").parent().addClass("oculto");
		$("#form_skill").parent().addClass("oculto");
		$("#form_action").change(function(){
			$("#form_CD").parent().addClass("oculto");
			$("#form_pj2").parent().addClass("oculto");
			$("#form_skill").parent().addClass("oculto");
			if($("#form_action").val()!="TiradaDificultad"){
				$("#form_pj2").parent().removeClass("oculto");
				if($("#form_action").val()==="TiradaEnfrentada"){
					$("#form_skill").parent().removeClass("oculto");
				}
			}else{
				$("#form_skill").parent().removeClass("oculto");
				$("#form_CD").parent().removeClass("oculto");
			}
		});
	}
	if($("#paneltable").text().length>77){
		$("#panel").removeClass("oculto");
	}
	$(".contenedor").removeClass("oculto");
});