
function loadCake(data, name_key, value_key, series_name) {
  var legend_data = [];
  var series_data = [];

  $.each(data, function (index, value) {
    legend_data.push(value);
    series_data.push({
      name: value[name_key],
      value: value[value_key]
    });
  });

  var option = {
    tooltip: {
      trigger: 'item',
      formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
      orient: 'vertical',
      left: 'left',
      data: legend_data
    },
    series: [
      {
        name: series_name,
        type: 'pie',
        data: series_data,
        itemStyle: {
          emphasis: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowColor: 'rgba(0, 0, 0, 0.5)'
          }
        }
      }
    ]
  };

  echarts.init(document.getElementById(value_key)).setOption(option);
}

function loadMap(data, name_key, value_key) {
  var series_data = [];

  $.each(data, function (index, value) {
    series_data.push({
      name: value[name_key] ? value[name_key].replace('省', '').replace('市', '') : '未知',
      value: value[value_key]
    });
  });

  var option = {
    tooltip: {
      trigger: 'item'
    },
    visualMap: {
      min: 0,
      max: 2000,
      left: 'left',
      top: 'bottom',
      text: ['高','低'],
      calculable: true
    },
    series: [
      {
        name: '区域',
        type: 'map',
        mapType: 'china',
        roam: false,
        data: series_data
      }
    ]
  };

  echarts.init(document.getElementById(value_key)).setOption(option);
}

function loadMultilayerCake(
  data, exterior_data,
  name_key, value_key, series_name,
  exterior_name_key, exterior_value_key, exterior_series_name
) {
  var series_data = [];
  var exterior_series_data = [];

  $.each(data, function (index, value) {
    series_data.push({
      name: value[name_key],
      value: value[value_key]
    });
  });

  $.each(exterior_data, function (index, value) {
    exterior_series_data.push({
      name: value[exterior_name_key],
      value: value[exterior_value_key]
    });
  });

  var option = {
    tooltip: {
      trigger: 'item',
      formatter: "{a} <br/>{b}: {c} ({d}%)"
    },
    series: [
      {
        name:series_name,
        type:'pie',
        selectedMode: 'single',
        radius: [0, '35%'],

        label: {
          normal: {
            position: 'inner'
          }
        },
        labelLine: {
          normal: {
            show: false
          }
        },
        data: series_data
      },
      {
        name: exterior_series_name,
        type:'pie',
        radius: ['45%', '60%'],
        label: {
          normal: {
            formatter: '{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}  ',
            backgroundColor: '#eee',
            borderColor: '#aaa',
            borderWidth: 1,
            borderRadius: 4,
            rich: {
              a: {
                color: '#999',
                lineHeight: 22,
                align: 'center'
              },
              hr: {
                borderColor: '#aaa',
                width: '100%',
                borderWidth: 0.5,
                height: 0
              },
              b: {
                fontSize: 16,
                lineHeight: 33
              },
              per: {
                color: '#eee',
                backgroundColor: '#334455',
                padding: [2, 4],
                borderRadius: 2
              }
            }
          }
        },
        data: exterior_series_data
      }
    ]
  };

  echarts.init(document.getElementById(value_key)).setOption(option);
}

function loadLine(data, x_key, y_key, title) {
  var xData = [];
  var yData = [];

  $.each(data, function (index, value) {
    xData.push(value[x_key]);
    yData.push(value[y_key]);
  });

  var option = {
    backgroundColor: '#fff',
    tooltip: {
      trigger: 'axis',
      axisPointer: {
        lineStyle: {
          color: '#333'
        }
      }
    },
    grid: {
      left: '3%',
      right: '4%',
      bottom: '3%',
      containLabel: true
    },
    xAxis: [{
      type: 'category',
      boundaryGap: false,
      axisLine: {
        lineStyle: {
          color: '#ccc'
        }
      },
      axisLabel: {
        margin: 10,
        textStyle: {
          fontSize: 14,
          color: '#999'
        }
      },
      data: xData
    }],
    yAxis: [{
      type: 'value',
      axisTick: {
        show: false
      },
      axisLine: {
        lineStyle: {
          color: '#fff'
        }
      },
      axisLabel: {
        margin: 10,
        textStyle: {
          fontSize: 14,
          color: '#999'
        }
      },
      splitLine: {
        lineStyle: {
          type: 'solid',
          color: '#ccc'
        }
      }
    }],
    series: [{
      name: title,
      type: 'line',
      smooth: true,
      symbol: 'circle',
      symbolSize: 5,
      showSymbol: false,
      lineStyle: {
        normal: {
          width: 2
        }
      },
      areaStyle: {
        normal: {
          color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
            offset: 0,
            color: 'rgba(0, 136, 212, 0.2)'
          }, {
            offset: 1,
            color: 'rgba(0, 136, 212, 0)'
          }], false),
          shadowColor: 'rgba(0, 0, 0, 0.1)',
          shadowBlur: 10
        }
      },
      itemStyle: {
        normal: {
          color: 'rgb(0,136,212)',
          borderColor: 'rgba(0,136,212,0.2)',
          borderWidth: 12
        }
      },
      data: yData
    }]
  };

  echarts.init(document.getElementById(y_key)).setOption(option);
}
