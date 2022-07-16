var gulp         = require('gulp'),
    //sass         = require('gulp-sass');
    concat       = require('gulp-concat'), // Подключаем gulp-concat (для конкатенации файлов)
    uglify       = require('gulp-uglify-es').default, // Подключаем gulp-uglifyjs (для сжатия JS)
    cssnano      = require('gulp-cssnano'), // Подключаем пакет для минификации CSS
    sourcemaps   = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    rename       = require('gulp-rename'); // Подключаем библиотеку для переименования файлов
    include      = require('gulp-include');
    imagemin     = require('gulp-imagemin'); // сжиматель твоего очка
    const sass = require('gulp-sass')(require('sass'));
gulp.task('sass', function() {
    return gulp.src([
        'src/scss/mixins/*.scss',
        'src/scss/ui/*.scss',
        'src/scss/plugins/*.scss',
        'src/scss/parts/**/*.scss',
        'src/scss/blocks/*.scss',
        'src/scss/components/*.scss',
        'src/scss/pages/**/*.scss',
        'src/scss/responsive/*.scss',
    ])
    //.pipe(sourcemaps.init())
    .pipe(sass()) // Преобразуем Sass в CSS посредством gulp-sass
    .pipe(concat('bundle.css'))
    .pipe(autoprefixer({
        Browserslist: ['last 3 versions'],
        grid: true,
        cascade: false
    }))
    .pipe(sourcemaps.write('././maps'))
    .pipe(cssnano()) // Сжимаем
    .pipe(gulp.dest('dist/css')); // Выгружаем в папку dest/css
});

gulp.task('scripts', function() {
    return gulp.src([
        'src/js/plugins/**/*.js',
        'src/js/blocks/**/*.js',
        'src/js/components/**/*.js',
        'src/js/pages/**/*.js',
        'src/js/parts/**/*.js',
        ])
        .pipe(concat('bundle.js')) // Собираем их в кучу в новом файле
        //.pipe(uglify()) // Сжимаем JS файл
        .pipe(gulp.dest('dist/js')); // Выгружаем в папку src/js
});

gulp.task('fonts', function() {
    return gulp.src('src/fonts/*')
    .pipe(gulp.dest('dist/fonts'))
})

gulp.task('images', function() {
    return gulp.src('src/img/**/*')
    // .pipe(imagemin())
    .pipe(gulp.dest('dist/img'))
});

// watch 
gulp.task('watch', gulp.series('sass', 'scripts', 'fonts', 'images', function() {
    gulp.watch('src/scss/**/*.scss', gulp.series('sass'));
    gulp.watch('src/js/blocks/**/*.js', gulp.series('scripts'));
    gulp.watch('src/js/components/**/*.js', gulp.series('scripts'));
    gulp.watch('src/js/pages/**/*.js', gulp.series('scripts'));
    //gulp.watch('src/img/*', gulp.series('images'));
}));