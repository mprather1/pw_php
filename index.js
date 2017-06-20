var request = require('request')
var stream = require('stream')
var http = require('http')
var util = require('util')
var url = require('url')
var qs = require('querystring')
var Transform = stream.Transform || require('readable-stream')

http.createServer(function (req, res) {
  var parsedURL = url.parse(req.url, true)
  var data = []
  var body = ''
  var parse = new ParseResponse()

  if (req.method === 'GET' && !parsedURL.query.id) {
    parse.on('data', function (response) {
      data.push(response)
    })

    parse.on('end', function () {
      res.setHeader('Content-Type', 'application/json')
      res.write(data.toString())
      res.end()
    })

    request('http://shintech.ninja:8000/get_all.php').pipe(parse)
  }

  if (req.method === 'GET' && parsedURL.query.id) {
    parse.on('data', function (response) {
      data.push(response)

      if (data.length > 1e6) {
        req.connection.destroy()
      }
    })

    parse.on('end', function () {
      res.setHeader('Content-Type', 'application/json')
      res.write(data.toString())
      res.end()
    })

    request('http://shintech.ninja:8000/get_one.php?id=' + parsedURL.query.id).pipe(parse)
  }

  if (req.method === 'POST') {
    req.on('data', function (response) {
      body += response

      if (body.length > 1e6) {
        req.connection.destroy()
      }
    })

    req.on('end', function () {
      var post = qs.parse(body)
      request.post('http://shintech.ninja:8000/post.php', {form: post}).pipe(res)
    })
  }

  if (req.method === 'PUT' && parsedURL.query.id) {
    req.on('data', function (response) {
      body += response

      if (body.length > 1e6) {
        req.connection.destroy()
      }
    })

    req.on('end', function () {
      request.post('http://shintech.ninja:8000/update.php?id=' + parsedURL.query.id, {form: JSON.parse(body)}).pipe(res)
    })
  }

  if (req.method === 'DELETE' && parsedURL.query.id) {
    request.post('http://shintech.ninja:8000/delete.php', {form: {id: parsedURL.query.id}}).pipe(res)
  }
}).listen(3000, function () {
  console.log('Listening on port 3000...')
})

function ParseResponse (response) {
  if (!(this instanceof ParseResponse)) {
    return new ParseResponse(response)
  }

  Transform.call(this, response)
}

util.inherits(ParseResponse, Transform)

ParseResponse.prototype._transform = function (chunk, enc, cb) {
  this.push(chunk)
  cb()
}
