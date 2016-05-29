module.exports = function (grunt) {
  'use strict';

  var bootstrapScripts = [
    'assets/bootstrap/js/transition.js',
    'assets/bootstrap/js/alert.js',
    'assets/bootstrap/js/button.js',
    'assets/bootstrap/js/carousel.js',
    'assets/bootstrap/js/collapse.js',
    'assets/bootstrap/js/dropdown.js',
    'assets/bootstrap/js/modal.js',
    'assets/bootstrap/js/tooltip.js',
    'assets/bootstrap/js/popover.js',
    'assets/bootstrap/js/scrollspy.js',
    'assets/bootstrap/js/tab.js',
    'assets/bootstrap/js/affix.js'
  ];

  // Project configuration.
  grunt.initConfig({

    // Metadata.
    pkg: grunt.file.readJSON('package.json'),

    // Task configuration.
    clean: {
      js: 'scripts',
      css: 'stylesheets'
    },

    jshint: {
      options: { jshintrc: 'assets/bootstrap/js/.jshintrc' },
      grunt: {
        options: { jshintrc: 'assets/bootstrap/grunt/.jshintrc' },
        src: 'Gruntfile.js'
      },
      core: { src: 'js/*.js' }
    },

    concat: {
      core: {
        src: [
          bootstrapScripts,
          '<%= jshint.core.src %>'
        ],
        dest: 'scripts/<%= pkg.name %>.js'
      }
    },

    uglify: {
      options: {
        compress: { warnings: false },
        mangle: true,
      },
      core: {
        src: '<%= concat.core.dest %>',
        dest: 'scripts/<%= pkg.name %>.min.js'
      }
    },

    less: {
      core: {
        options: {
          strictMath: true,
          sourceMap: true,
          sourceMapURL: '<%= pkg.name %>.css.map',
          sourceMapFilename: 'stylesheets/<%= pkg.name %>.css.map',
          sourceMapRootpath: '..'
        },
        src: 'less/style.less',
        dest: 'stylesheets/<%= pkg.name %>.css'
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
        options: { map: true },
        src: '<%= less.core.dest %>'
      }
    },

    csscomb: {
      options: { config: 'assets/bootstrap/less/.csscomb.json' },
      core: {
        src: '<%= less.core.dest %>',
        dest: '<%= less.core.dest %>'
      }
    },

    csslint: {
      options: { csslintrc: 'assets/bootstrap/less/.csslintrc' },
      dist: '<%= less.core.dest %>'
    },

    cssmin: {
      options: {
        compatibility: 'ie8',
        keepSpecialComments: 0,
        advanced: false
      },
      core: {
        src: '<%= less.core.dest %>',
        dest: 'stylesheets/<%= pkg.name %>.min.css'
      }
    },

    assets_versioning: {
      js: {
        options: {
          tasks: ['uglify:core'],
          versionsMapFile: 'scripts/versionsMapJS.json'
        }
      },
      css: {
        options: {
          tasks: ['cssmin:core'],
          versionsMapFile: 'stylesheets/versionsMapCSS.json'
        }
      }
    },

    watch: {
      less: {
        files: [
          'less/**/*.less',
          'style/**/*.less'
        ],
        tasks: 'css',
        options: { livereload: true }
      },
      js: {
        files: '<%= jshint.core.src %>',
        tasks: 'js',
        options: { livereload: true }
      },
      grunt: {
        files: 'Gruntfile.js',
        tasks: 'dev',
        options: { livereload: true }
      }
    }

  });

  // These plugins provide necessary tasks.
  require('load-grunt-tasks')(grunt, { scope: 'devDependencies' });
  require('time-grunt')(grunt);

  // Tasks
  grunt.registerTask('test-js',   ['jshint', 'concat']);
  grunt.registerTask('dist-js',   ['test-js', 'assets_versioning:js']);
  grunt.registerTask('test-css',  ['less']);
  grunt.registerTask('dist-css',  ['test-css', 'autoprefixer', 'csscomb', 'csslint', 'assets_versioning:css']);

  // Tasks: Devlopment
  grunt.registerTask('js',        ['test-js']);
  grunt.registerTask('css',       ['test-css']);
  grunt.registerTask('dev',       ['test-js', 'test-css']);
  grunt.registerTask('default',   ['dev']);

  // Tasks: Production
  grunt.registerTask('build-js',  ['dist-js']);
  grunt.registerTask('build-css', ['dist-css']);
  grunt.registerTask('build',     ['clean', 'dist-js', 'dist-css']);

};
