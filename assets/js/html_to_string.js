function html_to_string(html) {
    return html.replaceAll('>','&gt;').replaceAll('<','&lt;')
}