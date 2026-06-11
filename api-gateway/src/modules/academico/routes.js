const express = require('express');
const { createProxyMiddleware } = require('http-proxy-middleware');
const env = require('../../config/env');

const router = express.Router();

router.use('/', createProxyMiddleware({
    target: env.DIRECTIVO_SERVICE_URL + '/api/academico',
    changeOrigin: true,
    pathRewrite: { '^/api/academico': '' }
}));

module.exports = router;
