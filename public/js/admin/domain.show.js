$(function () {
  $.get(app.url('/webApi/admin/domain/' + domain_id))
    .error(function () {
      alert('请求接口失败, 请刷新页面重试');
    })
    .done(function (response) {
      loadECharts(response);
    });

  function loadECharts(data) {

    loadMap(data.client_region, 'client_region', 'count_region', '区域分布');

    loadMultilayerCake(
      data.client_country, data.client_isp,
      'client_country', 'count_country', '国家',
      'client_isp', 'count_isp', '运营商'
    );

    loadMultilayerCake(
      data.client_os, data.client_browser,
      'client_os', 'count_os', '操作系统',
      'client_browser', 'count_browser', '浏览器'
    );
  }

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
});
