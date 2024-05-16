const {src, dest, watch, series } = require('gulp')
const sass = require('gulp-sass')(require('sass'))

//compeiler
function buildStyles(){
    return src('musclegroup.scss')
        .pipe(sass())
        .pipe(dest('css'))
}

function watchTask(){
    watch(['musclegroup.scss'], buildStyles)
}

exports.default = series(buildStyles,watchTask)
