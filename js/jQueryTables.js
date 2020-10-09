

function jQueryTable1(id_container, data, LimitRow, maxHeight) {

    if(Object.keys(data).length == LimitRow){
        $('#'+id_container).css({
            "overflow-y":"scroll",
            "max-height":maxHeight
        });
    }

    var thead = '<tr id="cabecera">';
	var first = Object.keys(data)[0];
    $.each(data[first],function(key,item){
        if ($.type(item)=='object'){
            thead += "<th colspan='"+
					/*(($(item).length)+1)*/+"" +
				"' style=' text-align: center;' >" + key + "</th>";
        }else {
            thead += '<th>' + key + '</th>';
        }
	});

	thead += '</tr>';

	$('#'+id_container+' .thead').empty();
	$('#'+id_container+' thead').append(thead);

	var tbody = "";

    $.each(data,function(key,record) {

    	tbody += '<tr data-toggle="tooltip" title="" id="row_'+key+'">'

		$.each(record,function(key2,item) {
			if ($.type(item)=='object'){
				tbody += '<td align="right"><div class="options_div">';
				$.each(item,function(key3,sub){
                    tbody += sub;
				});
				tbody +='</div></td>';
			}else {
                tbody += '<td>' + item + '</td>';
            }
		});

		tbody += '</tr>';

	});

	$('#'+id_container+' tbody').empty();
	$('#'+id_container+' tbody').append(tbody);

}

function jQueryTableSelectable1(id_container, data, LimitRow, maxHeight, check_name) {

    if(Object.keys(data).length == 0){
        $('#'+id_container).css({
            "overflow-y":"scroll",
            "max-height":maxHeight
        });
    }

    var thead = '<tr id="cabecera">';
    var first = Object.keys(data)[0];
    thead += '<th data-toggle="tooltip" title="seleccionar todos"> <input type="checkbox" onchange="select_all(this);" id="check_all" /> </th>';
    $.each(data[first],function(key,item){
        if ($.type(item)!='object'&&key!='Activo'){
            thead += '<th>' + key + '</th>';
        }
    });

    thead += '</tr>';

    $('#'+id_container+' .thead').empty();
    $('#'+id_container+' thead').append(thead);

    var tbody = "";

    $.each(data,function(key,record) {

        tbody += '<tr data-toggle="tooltip" title="" id="row_'+key+'">'
        tbody += '<td> <input type="checkbox" onchange="select_row(this);" id="'+check_name+'_'+key+'" name="'+check_name+'[]" value="'+key+'"/> </td>';
        $.each(record,function(key2,item) {
            if ($.type(item)!='object'&&key2!='Activo'){

                tbody += '<td align="right"><div class="options_div">' + item + '</div></td>';
            }
        });

        tbody += '</tr>';

    });

    $('#'+id_container+' tbody').empty();
    $('#'+id_container+' tbody').append(tbody);

}

function jQueryTable(id_container, data, LimitRow, maxHeight) {

    if ($('#'+id_container).height > maxHeight){
        $('#' + id_container).css({
            "overflow-y": "scroll",
            "max-height": maxHeight
        });
    }

    var table = '<table id="table" class="table table-striped projects">';
    var thead = '<thead class="thead"><tr id="cabecera">';
    var first = Object.keys(data)[0];
    $.each(data[first],function(key,item){
        if ($.type(item)=='object'){
            thead += "<th colspan='"+
                /*(($(item).length)+1)*/+"" +
                "' style=' text-align: center;' >" + key + "</th>";
        }else {
            thead += '<th>' + key + '</th>';
        }
    });

    thead += '</tr></thead>';

    table += thead;

    var tbody = "";

    var rowcount = 0;
    var pagecount = 0;
    $.each(data,function(key,record) {
        rowcount++;
        if (rowcount%LimitRow == 1) {
            pagecount++;
            hidden = (pagecount > 1) ? "hidden":"";
            tbody += '<tbody id="page' + pagecount + '" class="tbody '+hidden+'">';
        }
        tbody += '<tr data-toggle="tooltip" title="" id="row_'+key+'">'

        $.each(record,function(key2,item) {
            if ($.type(item)=='object'){
                tbody += '<td align="right"><div class="options_div">';
                $.each(item,function(key3,sub){
                    tbody += sub;
                });
                tbody +='</div></td>';
            }else {
                tbody += '<td>' + item + '</td>';
            }
        });

        tbody += '</tr>';
        if (rowcount % LimitRow == 0) {
            tbody += '</tbody>';
        }

    });

    if (rowcount > 1 && rowcount % LimitRow != 0) {
        tbody += '</tbody>';
    }

    table += tbody;

    table += "</table>";

    $('#'+id_container).empty();
    $('#'+id_container).append(table);

    if (pagecount > 1){
        fn_paginado(id_container,pagecount);
    }

}


function jQueryTableSelectable(id_container, data, LimitRow, maxHeight, check_name) {
    if ($('#'+id_container).height > maxHeight){
        $('#'+id_container).css({
            "overflow-y":"scroll",
            "max-height":maxHeight
        });
    }


    var table = '<table id="table" class="table table-striped projects">';
    var thead = '<thead class="thead"><tr id="cabecera">';
    var first = Object.keys(data)[0];
    thead += '<th data-toggle="tooltip" title="seleccionar todos"> <input type="checkbox" onchange="select_all(this);" id="check_all" /> </th>';
    $.each(data[first],function(key,item){
        if ($.type(item)!='object'&&key!='Activo'){
            thead += '<th>' + key + '</th>';
        }
    });

    thead += '</tr>';

    table += thead;

    var tbody = "";

    var rowcount = 0;
    var pagecount = 0;
    $.each(data,function(key,record) {
        rowcount++;
        if (rowcount % LimitRow == 1) {
            pagecount++;
            hidden = (pagecount > 1) ? "hidden":"";
            tbody += '<tbody id="page' + pagecount + '" class="tbody '+hidden+'">';
        }
        tbody += '<tr data-toggle="tooltip" title="" id="row_'+key+'">'
        tbody += '<td> <input type="checkbox" onchange="select_row(this);" id="'+check_name+'_'+key+'" name="'+check_name+'[]" value="'+key+'"/> </td>';

        $.each(record,function(key2,item) {
            if ($.type(item)!='object'&&key2!='Activo'){

                tbody += '<td align="right"><div class="options_div">' + item + '</div></td>';
            }
        });

        tbody += '</tr>';

        if (rowcount % LimitRow == 0) {
            tbody += '</tbody>';
        }

    });

    if (rowcount > 1 && rowcount % LimitRow != 0) {
        tbody += '</tbody>';
    }

    table += tbody;

    table += "</table>";

    $('#'+id_container).empty();
    $('#'+id_container).append(table);

    if (pagecount > 1){
        fn_paginado(id_container,pagecount);
    }
}

function fn_paginado(id_container,pagecount){
    var paginado = "<div class='paginado pull-right'>";

    paginado +=
        "<button id='"+id_container+"_ir_prim' class='btn btn-primary btn_paginado ir_primero' disabled='disabled' >" +
        "<span class='fa fa-angle-double-left'></span>" +
        "</button>" +
        "<button id='"+id_container+"_ir_ant' class='btn btn-primary btn_paginado ir_anterior' disabled='disabled'>" +
        "<span class='fa fa-angle-left'></span>" +
        "</button>";

    for(i=1;i<=pagecount;i++){
        props = (i==1)?{
            disabled:"disabled='disabled'",
            class:'btn-warning selected_p',
        }:{
            disabled:"",
            class:'btn-info',
        };
        paginado += "<button id='"+id_container+"_ir_pag"+i+"' class='btn btn_paginado ir_pagina "+props.class+"' "+props.disabled+">"+i+"</button>";
    }

    paginado +=
        "<button id='"+id_container+"_ir_sig' class='btn btn-primary btn_paginado ir_siguiente'>" +
        "<span class='fa fa-angle-right'></span>" +
        "</button>" +
        "<button id='"+id_container+"_ir_ult' class='btn btn-primary btn_paginado ir_ultimo'>" +
        "<span class='fa fa-angle-double-right'></span>" +
        "</button>";

    paginado += "</div>";
    $('#'+id_container).closest('div').append(paginado);
}

function select_row(check){
    if ($(check).is(':checked'))
        $(check).closest('tr').addClass('selected');
    else
        $(check).closest('tr').removeClass('selected');
}

function select_all(check) {
    var container = $(check).closest('div').attr('id');
    if ($(check).is(':checked'))
        $('#'+container+' :checkbox').each(function(a,b){
            if ($(b).attr('id')!='check_all')
                $(b).prop('checked', true).change();
        });
    else
        $('#'+container+' :checkbox').each(function(a,b){
            if ($(b).attr('id')!='check_all')
                $(b).prop('checked', false).change();
        });

}




$(document).on('click','.ir_primero',function () {
    paginas = $(this).parent().parent().find('table').find('tbody');
    paginas.each(function(a,b){
        if (a == 0){
            $(b).removeClass('hidden')
        }else{
            $(b).addClass('hidden');
        }
    });
});

$(document).on('click','.ir_anterior',function () {
    pagina = $(this).parent().parent().find('table').find('tbody ').not('.hidden');
    pagina = $(pagina).attr('id').replace('page','');
    ir_a_pagina(this,pagina-1);
    upd_paginado(this,pagina-1);
});

$(document).on('click','.ir_pagina',function () {
    container = $(this).parent().parent().attr('id');
    pagina = $(this).attr('id').replace(container+'_ir_pag','');
    ir_a_pagina(this,pagina);
    upd_paginado(this,pagina);
});

$(document).on('click','.ir_siguiente',function () {
    pagina = $(this).parent().parent().find('table').find('tbody ').not('.hidden');
    pagina = $(pagina).attr('id').replace('page','');

    ir_a_pagina(this,parseInt(pagina)+1);
    upd_paginado(this,parseInt(pagina)+1);
});

$(document).on('click','.ir_ultimo',function () {
    paginas = $(this).parent().parent().find('table').find('tbody');
    ir_a_pagina(this,paginas.length);
    upd_paginado(this,paginas.length);
});


function ir_a_pagina(ref,pagina){
    container = $(ref).parent().parent().attr('id');
    paginas = $(ref).parent().parent().find('table').find('tbody');
    paginas.each(function(a,b){
        if (a == pagina-1){
            $(b).removeClass('hidden')
        }else{
            $(b).addClass('hidden');
        }
    });
}

function upd_paginado(ref,pagina){
    paginado = $(ref).closest('div').find('button');
    container = $(ref).attr('id').split('_')[0];

    paginado.each(function(a,b){
        $(b).removeAttr('disabled');
        $(b).removeClass('selected_p');
        if ($(b).hasClass('ir_pagina')) {
            $(b).removeClass('btn-warning');
            $(b).addClass('btn-info');
        }
    });
    $('#'+container+"_ir_pag"+pagina).removeClass('btn-info');
    $('#'+container+"_ir_pag"+pagina).addClass('btn-warning');
    $('#'+container+"_ir_pag"+pagina).addClass('selected_p');
    $('#'+container+"_ir_pag"+pagina).attr('disabled','disabled');

    if (pagina == 1){
        $('#'+container+"_ir_prim").attr('disabled','disabled');
        $('#'+container+"_ir_ant").attr('disabled','disabled');
    }

    num_pags = paginado.length - 4;

    if (pagina == num_pags){
        $('#'+container+"_ir_sig").attr('disabled','disabled');
        $('#'+container+"_ir_ult").attr('disabled','disabled');
    }
}



function meses(key){
	var meses = {"01": "Enero", "02": "Febrero", "03": "Marzo",
				 "04": "Abril", "05": "Mayo", "06": "Junio",
				 "07": "Julio", "08": "Agosto","09": "Septiembre",
				 "10": "Octubre", "11": "Noviembre", "12": "Diciembre"}
	return meses[key]
}
