module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
			},
			build: {
				files: [{
					expand: true,
					src: '**/*.js',
					dest: 'build/includes/js',
					cwd: 'src/includes/js'
				}]
			}
		},
		imagemin: {
			options: {
				cache: false
			},

			dist: {
			files: [{
				expand: true,
				cwd: 'src/',
				src: ['**/*.{png,jpg,gif}'],
				dest: 'build/'
			}]
			}
		},
		copy: {
			files: {
				expand: true,
				cwd: 'src',                    // set working folder / root to copy
			    src: '**/*.{php,htaccess}',    // copy all .gif files
			    dest: 'build'                  // destination folder
			}
		},
		jshint: {
			files: [
				'src/includes/**/*.js',
				'!src/includes/js/**/*.js'
			],
		},
		watch: {
			options: {
				livereload: true,
			},
			all: {
				files: ['src/**/*', '!node_modules/**/*'],
				tasks: []
			},
			pages: {
				files: ['src/**/*.{php,html,htaccess}'],
				tasks: ['newer:copy']
			},
			js: {
				files: ['src/incluces/**/*.js'],
				tasks: ['js']
			},
			images: {
				files: ['src/images/**/*.{png,jpg,gif}'],
				tasks: ['newer:imagemin']
			}
		},
		notify: {
			options: {
				title: 'Build Successful',
				message: '<%= pkg.name %> build finished successfully.'
			},
			all: {

			}
		}
	});

	// measures the time each task takes
	require('time-grunt')(grunt);

	// Load the plugins that provides the tasks
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-notify');


	// Default task(s).
	grunt.registerTask('default', ['newer:jshint', 'newer:uglify', 'newer:imagemin', 'newer:copy', 'notify']);
	grunt.registerTask('watcher', ['newer:jshint', 'newer:uglify', 'newer:imagemin', 'newer:copy', 'notify']);
	grunt.registerTask('js', ['newer:jshint', 'newer:uglify', 'notify']);
	grunt.registerTask('images', ['newer:imagemin', 'newer:copy']);

};
