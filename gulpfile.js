const { src, dest, series, parallel, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'))
const babel = require('gulp-babel')
const minify = require('gulp-minify')
const imagemin = require('gulp-imagemin')
const rename = require('gulp-rename')
const cleanCSS = require('gulp-clean-css')
const gulpFilter = require('gulp-filter')
const zip = require('gulp-zip')
const browsersync = require('browser-sync').create()
const del = require('del')
const path = require('path')
const themeName = 'danielsmota-2025'
const port = 8080

const dir = `wp-content/themes/${themeName}`

const paths = {
  styles: {
    src: 'src/styles/**/*.scss',
    dest: dir,
  },
  scripts: {
    src: 'src/scripts/**/*.js',
    dest: `${dir}/scripts`,
  },
  images: {
    src: 'src/img/**/*',
    dest: `${dir}/img`,
  },
  fonts: {
    src: 'src/fonts/**/*',
    dest: `${dir}/fonts`,
  },
  php: {
    srcNull: 'src/php/**/*',
    src: 'src/php/**/!(_)*',
    dest: dir,
  },
  thumb: {
    src: 'src/screenshot.png',
    dest: dir
  },
  dist: {
    src: dir,
    dest: 'dist/'
  }
}

function bSync(done) {
  browsersync.init({
    proxy: `localhost:${port}`,
    port: 3000,
    open: false,
    notify: false
  })
  done()
}

function clean() {
  return del([`${paths.dist.dest}/**`], { force: true });
}

function styles() {
  const filterStyle = gulpFilter('**/style.css', { restore: true });

  return src(paths.styles.src)
    .pipe(sass({ silenceDeprecations: ['legacy-js-api'] }))
    .pipe(filterStyle)
    .pipe(dest(paths.styles.dest))
    .pipe(cleanCSS())
    .pipe(rename({ basename: 'style', suffix: '.min' }))
    .pipe(dest(paths.styles.dest))
    .pipe(browsersync.stream())
}

function scripts() {
  return src(paths.scripts.src, { sourcemaps: true })
    .pipe(babel())
    .pipe(dest(paths.scripts.dest))
    .pipe(minify())
    .pipe(dest(paths.scripts.dest))
    .pipe(browsersync.stream())
}

function images() {
  return src(paths.images.src, { encoding: false })
    .pipe(
      imagemin([
        imagemin.gifsicle({
          interlaced: true,
        }),
        imagemin.mozjpeg({
          progressive: true,
        }),
        imagemin.optipng({
          optimizationLevel: 5,
        }),
        imagemin.svgo({
          plugins: [
            {
              removeViewBox: false,
              collapseGroups: true,
            },
          ],
        }),
      ])
    )
    .pipe(dest(paths.images.dest))
    .pipe(browsersync.stream())
}

function php() {
  return src(paths.php.src)
    .pipe(dest(paths.php.dest))
    .pipe(browsersync.stream())
}

function thumb() {
  return src(paths.thumb.src, { encoding: false })
    .pipe(dest(paths.thumb.dest))
    .pipe(browsersync.stream())
}

function dist() {
  return src([
    `${dir}/**/*`,
    `!${dir}/**/*.map`,
    `!${dir}/**/*.scss`,
    `!${dir}/node_modules/**`,
  ], { base: 'wp-content/themes', encoding: false })
    .pipe(dest(paths.dist.dest))
}

// function zipTheme() {
//   return src(`${paths.dist.dest}${themeName}/**/*`)
//     .pipe(zip(`${themeName}.zip`))
//     .pipe(dest(paths.dist.dest))
// }


function watchFiles() {
  watch(paths.scripts.src, scripts)
  watch(paths.styles.src, styles)
  watch(paths.images.src, images)
  watch(paths.php.src, php)
  watch(paths.php.srcNull, php)
  watch(paths.thumb.src, php)
}

const dev = parallel(bSync, watchFiles)

const build = series(
  clean,
  parallel(styles, scripts, images, php, thumb),
  dist,
  // zipTheme
)

exports.styles = styles
exports.scripts = scripts
exports.images = images
exports.php = php
exports.thumb = thumb
exports.clean = clean
exports.dist = dist
// exports.zip = zipTheme
exports.build = build
exports.dev = dev
exports.default = series(build, dev)
