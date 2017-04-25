module.exports = function(grunt) {

    grunt.initConfig({
      sass: {
          dist: {
              files: {
                  'dist/main.css': 'src/main.scss'
              }
          }
      },

      watch: {
          files: 'src/main.scss',
          tasks: ['sass']
      }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['sass']);
    // grunt.registerTask('watch', ['watch']);

};
