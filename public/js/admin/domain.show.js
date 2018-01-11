$(function () {
  $.get(app.url('/webApi/admin/domain/' + domain_id))
    .error(function (response) {
      alert('请求接口失败, 请刷新页面重试');
    })
    .done(function (response) {
      loadECharts(response);
    });


  function loadECharts(data) {
    loadCake(data.client_country, 'client_country', 'count_country', '国家');
    loadCake(data.client_isp, 'client_isp', 'count_isp', '运营商');

    loadMap(data.client_region, 'client_region', 'count_region', '区域分布');
  }

  function loadCake(data, name_key, value_key, title) {
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
      title: {
        text: title,
        x: 'center'
      },
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
          name: '访问来源',
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

  function loadMap(data, name_key, value_key, title) {
    var series_data = [];

    $.each(data, function (index, value) {
      series_data.push({
        name: value[name_key].replace('省', '').replace('市', ''),
        value: value[value_key]
      });
    });

    console.log(series_data);

    var option = {
      title: {
        text: title,
        subtext: '',
        left: 'center'
      },
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
          name: '访问来源',
          type: 'map',
          mapType: 'china',
          roam: false,
          data: series_data
        }
      ]
    };

    echarts.init(document.getElementById(value_key)).setOption(option);
  }
});
