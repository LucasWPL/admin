class makeTable {
    constructor(colunas, url, status = false) {
        var array = [];
        $(colunas).each(function(k,v){
            array.push([k, v, 'input', 'text']);
        });
        this._colunas = array;
        this._grid = url;
        this._status = status;
    }

    get colunas() {
        return this._colunas;
    }
    set colunas(value) {
        this._colunas = value;
    }

    get grid() {
        return this._grid;
    }
    
    set grid(value) {
        this._grid = value;
    }

    get sql() {
        return this._sql;
    }
    
    set sql(value) {
        this._sql = value.replaceAll("\t", ' ').replaceAll("\r\n", '');
    }

    get status() {
        return this._status;
    }

    set status(value) {
        this._status = value;
    }

    get dateIds(){
        return this._dateIds;
    }
    
    set dateIds(ids){
        this._dateIds = ids;
    }

    get moneyIds(){
        return this._moneyIds;
    }
    
    set moneyIds(ids){
        this._moneyIds = ids;
    }

    get id(){
        return this._id;
    }
    
    set id(id){
        this._id = id;
    }
    
    verifyBusca(value, padrao = 'gridPrincipal'){
        var tableId = padrao;

        if(value == 'S') {
            $('#gridPrincipal').attr('id', 'formBusca');
            $('#gridPrincipal_camposPesquisa').attr('id', 'formBusca_camposPesquisa');
            $('#gridPrincipal_camposTitulo').attr('id', 'formBusca_camposTitulo');
            tableId = 'formBusca';
        };

        this.id = tableId;
    }
    
    setSelect(coluna, options, condicoes = false){
        var found = this.colunas.find(element => element[1][0]  === coluna);
        if(found) this.colunas[found[0]] = [found[0], found[1], 'select', options, condicoes];
    }

    setDateColumn(){
        $(this.dateIds).each(function(){
            $('[name='+this+']').daterangepicker({
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
                    "Mar??o",
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
            $('[name='+this+']').attr('autocomplete', 'off');
            
            $('[name='+this+']').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')).change();
            });

            $('[name='+this+']').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('').change();
            });
        });
    }

    setDate(ids, format = 'range'){
        $(ids).each((index, value)=>{
            var found = this.colunas.find(element => element[1][0]  === value);
            if(found) this.colunas[found[0]] = [found[0], found[1], 'date', 'text', format];
        });
        this.dateIds = ids;               
    }

    setMoneyColumn(){
        $(this.moneyIds).each(function(){
            $('[name='+this+']').maskMoney({
                thousands: '.', 
                decimal: ','
            });
        });
    }

    setMoney(ids, casas = 2){
        $(ids).each((index, value)=>{
            var found = this.colunas.find(element => element[1][0]  === value);
            if(found) this.colunas[found[0]] = [found[0], found[1], 'money', 'text', casas];
        });   
        this.moneyIds = ids;         
    }
    
    setNumber(ids){
        $(ids).each((index, value)=>{
            var found = this.colunas.find(element => element[1][0]  === value);
            if(found) this.colunas[found[0]] = [found[0], found[1], 'number', 'number'];
        });
    }

    setAttr(){
        $('.employee-search-'+this.id+'-input').css('min-width', '100px');
        $('.employee-search-'+this.id+'-input').click(function(){
            return false;
        });
        $('#id').attr('style', '');
        $('#id').css('min-width', '50px');
    }

    getCamposPesquisa(){
        var html = '<td><input type="checkbox"  id="bulkDelete"  /></td>';
        var id = this.id;
        $(this.colunas).each(function(key, value){
            if(value[2] != 'select') {
                html += '<td><input type="'+value[3]+'" class="form-control employee-search-'+id+'-input" name="'+value[1][0]+'" style="height: 33px !important; width: 100% !important;"></td>';
            }else{
                html += '<td><select name="'+value[1][0]+'" class="form-control employee-search-'+id+'-input" style="height: 33px !important; width: 100% !important;">';
                html += '<option></option>';
                $(value[3]).each(function(){
                    html += '<option value="'+this+'">'+this.capitalize()+'</option>';
                });
                html += '</select>';
            }
        });
        return html;
    }

    getCamposTitulo(){
        var html = '<th class="thCkechboxGrid"></th>';
        $(this.colunas).each(function(key, value){
            html += '<th>'+value[1][1]+'</th>';
        });
        return html;
    }

    setCamposPesquisas(){
        $('#'+this.id+'_camposTitulo').html(this.getCamposTitulo());
        $('#'+this.id+'_camposPesquisa').html(this.getCamposPesquisa());
        this.setAttr();
    }

    loadTable(){
        let grid = this.grid;
        let status = this.status;
        let sX = true;
        let sY = '475px';
        if(this.id == 'formBusca'){
            sX = ''; sY = '';
        }
        var tabela = $('#'+this.id).DataTable({
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
            "scrollX": sX,
            "scrollY": sY,
            "processing": true,
            "language": {
                "processing": "Aguarde...",
                "infoFiltered": "(Filtrando _MAX_ registros)"
            },
            "serverSide": true,
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                if(status != false ){
                    //MUDANDO AS CORES DAS COLUNAS DE ACORDO COM OS STATUS
                    if(grid == 'receita_select_grid.php' || grid == 'despesa_select_grid.php'){
                        if(aData[status] == 'Apagada') $('td', nRow).css('background-color', '#f2f2f2');
                        if(aData[status] == 'Baixada') $('td', nRow).css('background-color', '#A8E5E6');
                        if(aData[status] == 'Baixa parcial') $('td', nRow).css('background-color', '#d7f3f4');
                        if(aData[status] == 'Vencida') $('td', nRow).css('background-color', '#F5A893');
                    }else if(grid == 'fluxo_caixa_select_grid.php'){
                        if(aData[status] == 'Receita') $('td', nRow).css('background-color', '#A8E5E6');
                        if(aData[status] == 'Despesa') $('td', nRow).css('background-color', '#F5A893');
                    }			
                }
            },
            "fnDrawCallback": (data)=>{
                this.sql = data.json.sql;
            }
        });
        
        this.setDateColumn();
        this.setMoneyColumn();
        
        $('#'+this.id+'_filter').css('display', 'none');
        $('#'+this.id+'').css({
            "border-color": "#d1d1d1", 
            "border-width":"1px", 
            "border-style":"solid"
        });
        $('.employee-search-'+this.id+'-input').on('keyup change', function (event) {
            var i = $(this).attr('name'); // getting column index
            var v = $(this).val(); // getting search input value
            $(colunas).each((key, value)=>{
                if(value[0] == i) i = key;
            });
            tabela.columns(i).search(v).draw();
        });

        return tabela;
    }

    make(){     
        this.setCamposPesquisas();
        return this.loadTable();
    }

    openRelatorio(url, data) {
        var form = document.createElement("form");
        form.target = "_blank";
        form.method = "POST";
        form.action = url;
        form.style.display = "none";
    
        for (var key in data) {
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = key;
            input.value = data[key];
            form.appendChild(input);
        }
    
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }

    relatorio(){
        let aux = getCurrentPage();
        this.openRelatorio('_backend/_view/_relatorio/relatorio.php', {
            sql: this.sql,
            tituloRelatorio: aux[2],
            colunas: JSON.stringify(this.colunas)
        });
    }
}