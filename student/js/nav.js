// vue - nav

let nav = new Vue({
  el: '#nav',
  data: {
    tagNames_tch: ['个人信息', '进入考试', '考试记录', '成绩公示'],
    urls_tch: ['student.php', 'paper_select.php', 'student_history.php', '../admin/grades_select.php']
  },
  methods: {
    isActiveClass: function (url) {
      if (window.location.href.indexOf(url) > 0) {
        return ('nav-link active');
      } else {
        return ('nav-link');
      }
    }
  }
})