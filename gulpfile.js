const argv         = require('minimist')(process.argv.slice(2));
const gulp         = require('gulp');
const del          = require('del');
const rename       = require('gulp-rename');
const sass         = require('gulp-sass');
const postcss      = require('gulp-postcss');
const pixrem       = require('pixrem');
const autoprefixer = require('autoprefixer');
const cssmin       = require('gulp-cssmin');
const browserSync  = require('browser-sync').create();

const browserslist = [
    'last 3 versions',
    '>= 1%',
    'Chrome >= 45',
    'Firefox >= 38',
    'Edge >= 12',
    'Explorer >= 10',
    'iOS >= 9',
    'Safari >= 9',
    'Android >= 4.4',
    'Opera >= 30'
];

const dist = [
    '**',
    '!.**',
    '!dist{,/**}',
    '!node_modules{,/**}',
    '!sass{,/**}',
    '!src{,/**}',
    '!gulpfile.js',
    '!package.json',
    '!package-lock.json'
];

gulp.task('clean', function() {
    return del(['css/', 'dist/']);
});

gulp.task('sass', function() {
    var postCSSplugins = [
        require('postcss-flexibility'),
        pixrem(),
        autoprefixer({browsers: browserslist})
    ];
    return gulp.src('sass/*.scss')
    .pipe(sass({
        includePaths: 'sass',
        outputStyle: 'expanded',
        precision: 8
    }).on('error', sass.logError))
    .pipe(postcss(postCSSplugins))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
});

gulp.task('styles', gulp.series('sass', function css() {
    return gulp.src(['css/*.css', '!css/*.min.css'])
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('css/'))
    .pipe(browserSync.stream());
}));

gulp.task('dist', function() {
    return gulp.src(dist)
    .pipe(gulp.dest('dist/'));
});

if (argv.production) {
    gulp.task('build', gulp.series('clean', 'styles', 'dist'));
} else {
    gulp.task('build', gulp.series('clean', 'sass'));
}

gulp.task('default', gulp.series('build', function watch() {
    browserSync.init({
        ghostMode: false,
        notify: false,
        online: false,
        open: false,
        host: argv.URL || 'localhost',
        proxy: argv.URL || 'localhost',
    });

    gulp.watch('sass/**/*.scss', gulp.series('sass'));

    gulp.watch('**/*.php').on('change', browserSync.reload);
}));
