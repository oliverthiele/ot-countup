import { build } from 'esbuild';
import { compile } from 'sass';

await build({
  entryPoints: ['Resources/Private/JavaScript/CountUp.ts'],
  outfile: 'Resources/Public/JavaScript/CountUp.min.js',
  minify: true,
  format: 'iife',
  target: 'es2020',
});

const compiledCss = compile('Resources/Private/Scss/CountUp.scss').css;

await build({
  stdin: {
    contents: compiledCss,
    loader: 'css',
    resolveDir: '.',
  },
  outfile: 'Resources/Public/Css/CountUp.min.css',
  minify: true,
});

console.log('ot-countup: built Resources/Public/JavaScript/CountUp.min.js and Resources/Public/Css/CountUp.min.css');
