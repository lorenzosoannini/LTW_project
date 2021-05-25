var primo="primo";
var secondo="secondo";
var terzo="terzo";
var quarto="quarto";
var primo_=100;
var secondo_=60;
var terzo_=50;
var quarto_=40;

function reqListener () {
    console.log(this.responseText);
  }
  var oReq = new XMLHttpRequest();
  oReq.onload = function() {
    var testo=this.responseText;
    var testo2=testo.replace(/\"/g,'§');
    var testo3=testo2.split("§"); //array
    quinto=testo3[17];
    quinto_=Number(testo3[19]);
    quarto=testo3[13];
    quarto_=Number(testo3[15]);
    terzo=testo3[9];
    terzo_=Number(testo3[11]);
    secondo=testo3[5];
    secondo_=Number(testo3[7]);
    primo=testo3[1];
    primo_=Number(testo3[3]);

    today=new Date()
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Aggiornato alle '+today.getHours()+':'+today.getMinutes()+' del '+today.getDate()+'/'+(today.getMonth()+1)+'/'+(today.getYear()-100)
        },
        subtitle: {
            text: 'Top 5'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Numero di pubblicazioni'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [
            {
                name: "Numero di ricerche",
                colorByPoint: true,
                data: [
                    {
                        name: primo,
                        y: primo_
                    },
                    {
                        name: secondo,
                        y: secondo_
                    },
                    {
                        name: terzo,
                        y: terzo_
                    },
                    {
                        name: quarto,
                        y: quarto_
                    },
                    {
                        name: quinto,
                        y: quinto_
                    },
                ]
            }
        ],
        
    });

  };

oReq.open("get", "js/makeGraph.php", true);                       
oReq.send();