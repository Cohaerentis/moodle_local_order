'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'js/main.js',
        'js/onload.js'
      ]
    },
    less: {
      dist: {
        files: {
          'css/bootstrap.min.css': 'less/bootstrap/bootstrap.less',
          'css/main.min.css': 'less/main.less'
        },
        options: {
          compress: true,
          yuicompress: true,
          optimization: 2
        }
      },
      dev: {
        files: {
          'css/bootstrap.css': 'less/bootstrap/bootstrap.less',
          'css/main.css': 'less/main.less'
        }
      }
    },
    uglify: {
      dist: {
        files: {
          'js/bootstrap.min.js': [
            'js/bootstrap/transition.js',
            'js/bootstrap/alert.js',
            'js/bootstrap/button.js',
            'js/bootstrap/carousel.js',
            'js/bootstrap/collapse.js',
            'js/bootstrap/dropdown.js',
            'js/bootstrap/modal.js',
            'js/bootstrap/tooltip.js',
            'js/bootstrap/popover.js',
            'js/bootstrap/scrollspy.js',
            'js/bootstrap/tab.js',
            'js/bootstrap/affix.js'
          ],
          'js/main.min.js': 'js/main.js',
          'js/onload.min.js': 'js/onload.js',
        }
      }
    },
    concat: {
      options: {
        separator: ';',
      },
      dist: {
        src: [
          'js/bootstrap/transition.js',
          'js/bootstrap/alert.js',
          'js/bootstrap/button.js',
          'js/bootstrap/carousel.js',
          'js/bootstrap/collapse.js',
          'js/bootstrap/dropdown.js',
          'js/bootstrap/modal.js',
          'js/bootstrap/tooltip.js',
          'js/bootstrap/popover.js',
          'js/bootstrap/scrollspy.js',
          'js/bootstrap/tab.js',
          'js/bootstrap/affix.js',
        ],
        dest: 'js/bootstrap.js',
      },
    },
    watch: {
      less: {
        files: [
          'less/*.less',
          'less/bootstrap/*.less'
        ],
        tasks: ['less']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'uglify']
      },
    },
    clean: {
      dist: [
        'css/main.css',
        'css/main.min.css',
        'js/main.min.js',
        'js/onload.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-concat');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'less',
    'uglify',
    'concat'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
