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
					dest: 'dist/includes/js',
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
				dest: 'dist'
			}]
			}
		},
		copy: {
			files: {
				expand: true,
				cwd: 'src',                    // set working folder / root to copy
			    src: '**/*.{php,htaccess}',    // copy all .gif files
			    dest: 'dist'                   // destination folder
			},
			jquery:{
				src: 'bower_components/jQuery/dist/jquery.min.js',
				dest: 'dist/includes/js/jquery.js'
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
			full: {
				options: {
					title: 'Full Build Successful',
					message: '<%= pkg.name %>'
				}
			},
			watch: {
				options: {
					title: 'Watch Build Successful',
					message: '<%= pkg.name %>'
				}
			},
			js: {
				options: {
					title: 'JS Build Successful',
					message: '<%= pkg.name %>'
				}
			},
			images: {
				options: {
					title: 'Image Build Successful',
					message: '<%= pkg.name %>'
				}
			},
		},
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
	grunt.registerTask('default', ['newer:jshint', 'newer:uglify', 'newer:imagemin', 'newer:copy', 'notify:full']);
	grunt.registerTask('fullnoimg', ['jshint', 'uglify', 'copy', 'notify:full']);
	grunt.registerTask('full', ['jshint', 'uglify', 'imagemin', 'copy', 'notify:full']);
	grunt.registerTask('watcher', ['newer:jshint', 'newer:uglify', 'newer:imagemin', 'newer:copy:files', 'notify:watch']);
	grunt.registerTask('js', ['newer:jshint', 'newer:uglify', 'notify:js']);
	grunt.registerTask('images', ['newer:imagemin', 'newer:copy', 'notify:images']);

};
