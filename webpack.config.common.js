const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = {
  mode: "development",
  entry: {
    jg: path.resolve(__dirname, "./resource/js/index.js"),
  },
  output: {
    filename: "[name].bundle.js",
    path: path.resolve(__dirname, "./web/app/themes/jungolmok/assets/dist"),
  },
  plugins: [
    new CleanWebpackPlugin({
      path: path.resolve(__dirname, "./web/app/themes/jungolmok/assets/dist")
    }),
    new MiniCssExtractPlugin({
      filename: "[name].css"
    })
  ],
  module: {
    rules: [
      {
        test: /\.(s[ac]|c)ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              importLoaders: 1,
              url: false,
            }
          },
          { loader: 'postcss-loader' }
        ]
      },
    ]
  }
}