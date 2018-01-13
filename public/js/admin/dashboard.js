$(function () {
  $.get(app.url('/webApi/admin/viewCount'))
    .error(function () {
      alert('请求接口失败, 请刷新页面重试');
    })
    .done(function (response) {
      loadECharts(response);
    });

  function loadECharts(data) {
    loadLine(data, 'view_date', 'view_count', '最近7日访问量')
  }
});
