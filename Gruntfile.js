module.exports = function (grunt) {
  'use strict';

  grunt.initConfig({

    // Metadata.
    pkg: grunt.file.readJSON('package.json'),

    // Task configuration.
    clean: {
      dist: [
        '<%= less.core.dest %>',
        '<%= less.core.options.sourceMapFilename %>',
        '<%= cssmin.core.dest %>',
        '<%= concat.core.dest %>',
        '<%= uglify.core.dest %>',
      ]
    },

    jshint: {
      options: {
        jshintrc: 'js/.jshintrc'
      },
      grunt: {
        options: {
          jshintrc: '.jshintrc'
        },
        src: 'Gruntfile.js'
      },
      core: {
        src: 'js/project.js'
      }
    },

    concat: {
      core: {
        src: [
          'assets/bootstrap/dist/js/bootstrap.js',
          '<%= jshint.core.src %>'
        ],
        dest: 'js/script.js'
      }
    },

    uglify: {
      core: {
        src: '<%= concat.core.dest %>',
        dest: 'js/script.min.js'
      }
    },

    less: {
      core: {
        options: {
          strictMath: true,
          sourceMap: true,
          sourceMapURL: 'style.css.map',
          sourceMapFilename: 'css/style.css.map',
          sourceMapRootpath: '..',
        },
        src: 'less/style.less',
        dest: 'css/style.css'
      }
    },

    autoprefixer: {
      options: {
        browsers: [
          'Android 2.3',
          'Android >= 4',
          'Chrome >= 20',
          'Firefox >= 24',
          'Explorer >= 8',
          'iOS >= 6',
          'Opera >= 12',
          'Safari >= 6'
        ]
      },
      core: {
        options: {
          map: true
        },
        src: '<%= less.core.dest %>'
      },
    },

    csscomb: {
      options: {
        config: 'less/.csscomb.json'
      },
      dist: {
        expand: true,
        cwd: 'css/',
        src: ['*.css', '!*.min.css'],
        dest: 'css/'
      },
    },

    csslint: {
      options: {
        csslintrc: 'less/.csslintrc'
      },
      dist: '<%= less.core.dest %>'
    },

    cssmin: {
      options: {
        compatibility: 'ie8',
        keepSpecialComments: '*',
        noAdvanced: true
      },
      core: {
        src: '<%= less.core.dest %>',
        dest: 'css/style.min.css'
      }
    },

    modernizr: {
      dist: {
        "devFile" : "assets/modernizr/modernizr.js",
        "outputFile" : "js/modernizr.min.js",
        "extra" : {
          "shiv" : false,
        },
        "files" : {
          "src": ['js/project.js', 'css/style.min.css']
        }
      }
    },

    watch: {
      less: {
        files: ['less/**/*.less', 'style/**/*.less'],
        tasks: 'css',
        options: { livereload: true }
      },
      js: {
        files: '<%= jshint.core.src %>',
        tasks: 'js'
      }
    }

  });

  // These plugins provide necessary tasks.
  require('load-grunt-tasks')(grunt, { scope: 'devDependencies' });
  require('time-grunt')(grunt);

  // Register tasks
  grunt.registerTask('test-js',   ['jshint', 'concat']);
  grunt.registerTask('dist-js',   ['test-js', 'uglify']);
  grunt.registerTask('test-css',  ['less']);
  grunt.registerTask('dist-css',  ['test-css', 'autoprefixer', 'csscomb', 'csslint', 'cssmin']);

  // Resister tasks: devlopment
  grunt.registerTask('js',        ['test-js']);
  grunt.registerTask('css',       ['test-css']);
  grunt.registerTask('dev',       ['test-js', 'test-css']);
  grunt.registerTask('default',   ['dev']);

  // Resister tasks: production
  grunt.registerTask('build-js',  ['dist-js', 'modernizr']);
  grunt.registerTask('build-css', ['dist-css']);
  grunt.registerTask('build',     ['clean', 'dist-js', 'dist-css', 'modernizr']);

};
