class makeTable {
    constructor(colunas, url, status = false) {
        var array = [];
        $(colunas).each(function(k,v){
            array.push([k, v, 'input', 'text']);
        });
        this.colunas = array;
        this.grid = url;
        this.status = status;
    }

    get getColunas() {
        return this.colunas;
    }

    get getGrid() {
        return this.grid;
    }

    get getStatus() {
        return this.status;
    }
    
    setSelect(coluna, options){
        var found = this.colunas.find(element => element[1]  === coluna);
        this.colunas[found[0]] = [found[0], found[1], 'select', options];
    }

    setDate(ids){
        $(ids).each(function(){
            $('#'+this).daterangepicker({
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Janeiro",	
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 1
                }
            });
            $('#'+this).attr('autocomplete', 'off');
            
            $('#'+this).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')).change();
            });

            $('#'+this).on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('').change();
            });
        });       
    }
    
    setAttr(){
        $('.employee-search-gridPrincipal-input').css('min-width', '100px');
        $('.employee-search-gridPrincipal-input').click(function(){
            return false;
        });
        $('#id').attr('style', '');
        $('#id').css('min-width', '50px');
    }

    getHtml(){
        var html = '<td><input type="checkbox"  id="bulkDelete"  /></td>';
        $(this.colunas).each(function(k,v){
            if(v[2] == 'input') {
                html += '<td><input type="'+v[3]+'" class="form-control employee-search-gridPrincipal-input" id="'+v[1]+'"></td>';
            }else if(v[2] == 'select'){
                var aux = v[3].split('; ');
                html += '<td><select id="'+v[1]+'" class="form-control employee-search-gridPrincipal-input">';
                html += '<option></option>';
                $(aux).each(function(){
                    html += '<option value="'+this+'">'+this+'</option>';
                });
                html += '</select>';
            }
        });
        return html;
    }

    setCamposPesquisas(){
        $('#camposPesquisa').html(this.getHtml());
        this.setAttr();
    }

    loadTable(){
        let grid = this.grid;
        let status = this.status;
        var tabela = $('#gridPrincipal').DataTable({
            "ajax":
            {
                "url": '_backend/_controller/_select/_grid/'+this.grid+'',
                "data": {
                "colunas": this.colunas
            }},
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": true,
            "language": {
                "processing": "Aguarde...",
                "infoFiltered": "(Filtrando _MAX_ registros)"
            },
            "serverSide": true,
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                if(status != false ){
                    //MUDANDO AS CORES DAS COLUNAS DE ACORDO COM OS STATUS
                    if(grid == 'receita_select_grid.php'){
                        if(aData[status] == 'Apagada') $('td', nRow).css('background-color', '#f2f2f2');
                        if(aData[status] == 'Baixada') $('td', nRow).css('background-color', '#ccffdd');
                        if(aData[status] == 'Baixa parcial') $('td', nRow).css('background-color', '#e6ffee');
                        if(aData[status] == 'Vencida') $('td', nRow).css('background-color', '#ff9980');
                    }else if(grid == 'fluxo_caixa_select_grid.php'){
                        if(aData[status] == 'Receita') $('td', nRow).css('background-color', '#ccffdd');
                        if(aData[status] == 'Despesa') $('td', nRow).css('background-color', '#ffc2b3');
                    }			
                }
            }
        });
        $('#gridPrincipal_filter').css('display', 'none');
        $('#gridPrincipal').css({
            "border-color": "#d1d1d1", 
            "border-width":"1px", 
            "border-style":"solid"
        });
        $('.employee-search-gridPrincipal-input').on('keyup change', function (event) {
            var i = $(this).attr('id'); // getting column index
            var v = $(this).val(); // getting search input value
            i = colunas.indexOf(i);
            tabela.columns(i).search(v).draw();
        });

        return tabela;
    }

    make(){        
        this.setCamposPesquisas();
        this.loadTable();
    }
}