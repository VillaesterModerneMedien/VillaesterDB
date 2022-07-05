jQuery(function($) {
  var token = window.Joomla.getOptions('csrf.token', '');

  var id = $('#hiddenID').val();

  var formData = $('#lccCalcForm' ).serialize();
  ajaxGetValues(formData, id);

  $('#btnKostenentwicklung').on('click',function(e){
    e.preventDefault();
    formData = $('#lccCalcForm' ).serialize();
    getKostenentwicklung(formData, id);
    UIkit.modal($('#kostenentwicklungModal')).show();
  });

  $('#getPDF').on('click',function(e){
    e.preventDefault();
    formData = $('#lccCalcForm' ).serialize();
    getPDF(formData, id);
    UIkit.modal($('#kostenentwicklungModal')).show();
  });

  // Range Slider Change

  $('#F3').on('change',function(e){
    formData = $('#lccCalcForm' ).serialize();
    ajaxGetValues(formData, id);
    var yearsSlider = parseInt($(this).val());
    $('.yearsSlider').text(yearsSlider)

    if(yearsSlider >= 35)
    {
      $('.totalSubhead').addClass('totalOverload')
      $('.totalSum').addClass('totalOverload')
      $('.warnHinweis').removeClass('warnHinweisOut')
    }
    else{
      $('.totalSubhead').removeClass('totalOverload')
      $('.totalSum').removeClass('totalOverload')
      $('.warnHinweis').addClass('warnHinweisOut')
    }

    if (yearsSlider < 45) {
      $('#F62').val(1)
    } else if (yearsSlider < 30) {
      $('#F62').val(0);
    } else {
      $('#F62').val(2);
    }

    if (yearsSlider < 40) {
      $('#F64').val(1)
    } else if (yearsSlider < 20) {
      $('#F64').val(0);
    } else {
      $('#F64').val(2);
    }

    if (yearsSlider < 50) {
      $('#F66').val(4)
    } else if (yearsSlider < 35) {
      $('#F66').val(3);
    } else if (yearsSlider < 25) {
      $('#F66').val(2);
    } else if (yearsSlider < 15) {
      $('#F66').val(1);
    } else if (yearsSlider < 10) {
      $('#F66').val(0);
    } else {
      $('#F66').val(5);
    }

    if (yearsSlider < 30) {
      $('#B66').val(0)
    } else {
      $('#B66').val(1);
    }

    if (yearsSlider < 45) {
      $('#B68').val(2)
    } else if (yearsSlider < 40) {
      $('#B68').val(1);
    } else if (yearsSlider < 35) {
      $('#B68').val(0);
    } else {
      $('#B68').val(3);
    }

    var ueberdacht = $('#B35').val();

    if (yearsSlider > 40  && ueberdacht == 'nein') {
      $('#B70').val(1)
    } else {
      $('#B70').val(0);
    }
  });

  $('#B35').on('change', function(){
    if ($('#F3').val() > 40  && $(this).val() == 'nein') {
      $('#B70').val(1)
    } else {
      $('#B70').val(0);
    }
  })

  $('#B39').on('change', function(){
    var value = $(this).val();
    if(value == 'F30' || value == 'F90'){
      $('.warnHinweis2Out').addClass('warnHinweis2');
    }
    else{
      $('.warnHinweis2Out').removeClass('warnHinweis2');
    }
  })

  // Conditional Fields Frontend, siehe XLS

  $('#B88').on('change',function(e){
    var value = $(this).val();
    $('#F88').val(value);
  });

  $('#F31').on('change',function(e){
    var value = $(this).val();
    $('#F80').val(value);
  });

  $('#F33').on('change',function(e){
    var value = $(this).val();
    $('#F82').val(value);
  });

  $('#F62').on('change',function(e){
    var value = $(this).val();
    $('#F70').val(value);
  });

  $('#F70').on('change',function(e){
    var value = $(this).val();
    $('#F70').val(value);
  });

  $('#B29').on('change',function(e){
    stellplatz();
  });

  $('#B27').on('change',function(e){
    stellplatz();
  });

  $('#B25').on('change',function(e){
    var wrapper = $('#B37').parent('div');

    var bauweise = $(this).val();
    if(bauweise === 'Voll') {
      $("#B37 option[value='ja']").prop('selected', true);
      $("#B37").val('ja');
      $("#B37").attr('disabled', true);
      $(wrapper[0]).addClass('disabledWrapper')
    }
    else{
      $("#B37").attr('disabled', false);
      $(wrapper[0]).removeClass('disabledWrapper')
    }

    formData = $('#lccCalcForm' ).serialize();

  });


  function stellplatz(){
    var B29 = $('#B29').val();
    var B27 = $('#B27').val();
    console.log('B31', parseFloat(B29/B27));
    $('#B31').val(parseFloat(B29/B27));
  }



  var yearsSlider = $('#F3').val();
  $('.yearsSlider').text(yearsSlider)


  $('.inputChanger').on('change',function(e){
    e.preventDefault();
    formData = $('#lccCalcForm' ).serialize();
    ajaxGetValues(formData, id);
  });

  rangeColor(document.getElementById('F3'))
});

function ajaxGetValues(formData, id){
  $.ajax({
    url: 'index.php?option=com_vmmdatabase&task=customer.getResults&id=' + id,
    method: 'GET',
    dataType: 'json',
    data: formData ,
    success: function(result) {
      var data = result.data;
      //console.log(result.data);

      // Set Boxes

      $('#headline1').text(data.B94.labelTop);
      $('#headline2').text(data.E94.labelTop);
      $('#headline3').text(data.G94.labelTop);
      $('#headline4').text(data.H94.labelTop);

      $('#value1').text(data.B94.value);
      $('#value2').text(data.E94.value);
      $('#value3').text(data.G94.value);
      $('#value4').text(data.H94.value);

      CanvasJS.addCultureInfo('de',
        {
          decimalSeparator: ",",// Observe ToolTip Number Format
          digitGroupSeparator: ".", // Observe axisY labels
        });


      // Set Chart
      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
          text: ''
        },
        culture: 'de',
        axisY: {
          title: "Kosten",
          includeZero: true,
          labelFontFamily: 'Noto Sans',
          titleFontFamily: 'Noto Sans',
          valueFormatString:  "#,##0.## €",   // move comma to change formatting
        },
        axisX: {
          title: "",
          labelFontFamily: 'Noto Sans',
          valueFormatString:  "#,##0.## €",   // move comma to change formatting
        },
        legend: {
          cursor:"pointer",
          itemclick : toggleDataSeries,
          fontFamily: 'Noto Sans',
        },
        toolTip: {
          contentFormatter: function (e) {
            var number = e.entries[0].dataPoint.y;
            var currency = new Intl.NumberFormat('de-DE', {style: 'currency', currency: 'EUR'}).format(number);
            return currency;
          }
        },
        data: [{
          type: "bar",
          showInLegend: true,
          name: data.B94.labelTop,
          color: "#9cb61d",
          dataPoints: [
            { y: data.B94.rawvalue, label: data.B94.label },
            { y: data.B157.rawvalue, label: data.B157.label },
            { y: data.B184.rawvalue, label: data.B184.label },
            { y: data.B210.rawvalue, label: data.B210.label },
          ]
        },
          {
            type: "bar",
            showInLegend: true,
            name: data.E94.labelTop,
            color: "lightgrey",
            dataPoints: [
              { y: data.E94.rawvalue, label: data.B94.label },
              { y: data.E157.rawvalue, label: data.E157.label },
              { y: data.E184.rawvalue, label: data.E184.label },
              { y: data.E210.rawvalue, label: data.E210.label },
            ]
          },
          {
            type: "bar",
            showInLegend: true,
            name: data.G94.labelTop,
            color: "grey",
            dataPoints: [
              { y: data.G94.rawvalue, label: data.B94.label },
              { y: data.G157.rawvalue, label: data.G157.label },
              { y: data.G184.rawvalue, label: data.G184.label },
              { y: data.G210.rawvalue, label: data.G210.label },
            ]
          },
          {
            type: "bar",
            showInLegend: true,
            name: data.H94.labelTop,
            color: "#343434",
            dataPoints: [
              { y: data.H94.rawvalue, label: data.B94.label },
              { y: data.H157.rawvalue, label: data.H157.label },
              { y: data.H184.rawvalue, label: data.H184.label },
              { y: data.H210.rawvalue, label: data.H210.label },
            ]
          }]
      });
      chart.render();
    },
    error: function(e) {

    }
  });
}


function getKostenentwicklung(formData, id){
  $.ajax({
    url: 'index.php?option=com_vmmdatabase&task=customer.getKostenentwicklung&id=' + id,
    method: 'GET',
    dataType: 'json',
    data: formData ,
    success: function(result) {
      $('#preloader').fadeOut();

      var data = result.data;

      var dataPointsB94 = [{x:0,y:0}];
      var dataPointsE94 = [{x:0,y:0}];
      var dataPointsG94 = [{x:0,y:0}];
      var dataPointsH94 = [{x:0,y:0}];
      $.each(data, function( index, value ) {
          dataPointsB94.push({x:parseInt(index), y:value.B94})
          dataPointsE94.push({x:parseInt(index), y:value.E94})
          dataPointsG94.push({x:parseInt(index), y:value.G94})
          dataPointsH94.push({x:parseInt(index), y:value.H94})
      });

      CanvasJS.addCultureInfo('de',
        {
          decimalSeparator: ",",// Observe ToolTip Number Format
          digitGroupSeparator: ".", // Observe axisY labels
        });

      var chartKostenentwicklung = new CanvasJS.Chart("chartKostenentwicklung", {
        title: {
          text: ""
        },
        culture: 'de',
        axisX: {
          title: "Zeit (Jahre)",
          viewportMinimum: 0,
          interval: 2,
          labelFontSize: 12,
          titleFontSize: 20,
          gridDashType: "dot",
          gridThickness: 1,
          stripLines: [{
            value: 20,
            color: "transparent",
            label: "Dummy Long Label",
            labelMaxWidth: 100,
            labelPlacement: "outside",
            labelBackgroundColor: "transparent",
            labelFontColor: "transparent",
          }]
        },
        axisY: {
          title: "Kosten (EUR)",
          labelFontSize: 12,
          titleFontSize: 20,
          valueFormatString:  "#,##0.## €",   // move comma to change formatting
          stripLines: [{
            value: 30,
            color: "transparent",
            label: "Dummy Long Label",
            labelMaxWidth: 1000,
            labelPlacement: "outside",
            labelBackgroundColor: "transparent",
            labelFontColor: "transparent",
          }]
        },
        toolTip:{
          contentFormatter: function ( e ) {
            var number = e.entries[0].dataPoint.y;
            var currency = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(number);
            return e.entries[0].dataPoint.x + ' Jahre: ' +  currency;
          }
        },

        // begin data for 2 line graphs. Note dps1 and dps2 are
        //defined above as a json object. See http://www.w3schools.com/json/
        data: [

          { type: "line", markerSize: 2, markerColor: '#9cb61d', lineThickness: 4, lineColor: '#9cb61d', dataPoints: dataPointsB94 },
          { type: "line",  markerSize: 2, markerColor: 'lightgrey', lineThickness: 4,lineColor: 'lightgrey', dataPoints: dataPointsE94 },
          { type: "line", markerSize: 2, markerColor: 'grey', lineThickness: 4,lineColor: 'grey', dataPoints: dataPointsG94 },
          { type: "line", markerSize: 2, markerColor: '#343434', lineThickness: 4, lineColor: '#343434', dataPoints: dataPointsH94 }
        ]
        // end of data for 2 line graphs
      });
      chartKostenentwicklung.render();


    },
    error: function(e) {
      //console.log(e);
      //console.log('ajax call failed');
    }
  });

}


function getPDF(formData, id){
  $.ajax({
    url: 'index.php?option=com_vmmdatabase&task=customer.getPDF&id=' + id,
    method: 'GET',
    dataType: 'json',
    data: formData ,
    success: function(result) {
      var data = result.data;

    },
    error: function(e) {
      //console.log(e);
      //console.log('ajax call failed');
    }
  });

}


function toolTipFormatter(e) {
  var str = "";
  var total = 0 ;
  var str3;
  var str2 ;
  for (var i = 0; i < e.entries.length; i++){
    var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
    total = e.entries[i].dataPoint.y + total;
    str = str.concat(str1);
  }
  str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
  str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
  return (str2.concat(str)).concat(str3);
}

function rangeColor(input) {
  var wrp = document.createElement('div'),
    preBar = document.createElement('p'),
    min = parseInt(input.min, 10),
    max = parseInt(input.max, 10),
    range = max - min,
    getVal = function() {
      var w = parseInt(input.clientWidth, 10),
        t = ~~(w * (parseInt(input.value, 10) - min) / range);
      return t;
    };
  wrp.className = 'barCnt';
  preBar.className = 'preBar';

  input.className = input.className.length ? (input.className + ' colorized') : 'colorized';
  input.parentNode.replaceChild(wrp, input);

  wrp.appendChild(input);
  wrp.appendChild(preBar);

  input.addEventListener('input', function() {

    preBar.style.width = getVal() + 'px';
  });

  preBar.style.width = getVal() + 'px';
}


function toggleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else {
    e.dataSeries.visible = true;
  }
  chart.render();
}
