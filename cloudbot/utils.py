from flask import render_template

def render_template_or_json(template, **kwargs):
#    if request.authorization or request_wants_json():
#        structure = dict()
#        for k, v in kwargs.iteritems():
#            structure[k] = serialize_obj(v)
#        return json.dumps(structure)

    return render_template(template, **kwargs)