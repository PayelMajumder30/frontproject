@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Typography</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Headings
                </div>
                <div class="panel-body">
                    <h1>Heading 1
                        <small>Sub-heading</small>
                    </h1>
                    <h2>Heading 2
                        <small>Sub-heading</small>
                    </h2>
                    <h3>Heading 3
                        <small>Sub-heading</small>
                    </h3>
                    <h4>Heading 4
                        <small>Sub-heading</small>
                    </h4>
                    <h5>Heading 5
                        <small>Sub-heading</small>
                    </h5>
                    <h6>Heading 6
                        <small>Sub-heading</small>
                    </h6>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Paragraphs
                </div>
                <div class="panel-body">
                    <p class="lead">This is an example of lead body copy.</p>
                    <p>This is an example of standard paragraph text. This is an example of <a href="#">link anchor text</a> within body copy.</p>
                    <p>
                        <small>This is an example of small, fine print text.</small>
                    </p>
                    <p>
                        <strong>This is an example of strong, bold text.</strong>
                    </p>
                    <p>
                        <em>This is an example of emphasized, italic text.</em>
                    </p>
                    <br>
                    <h4>Alignment Helpers</h4>
                    <p class="text-left">Left aligned text.</p>
                    <p class="text-center">Center aligned text.</p>
                    <p class="text-right">Right aligned text.</p>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Emphasis Classes
                </div>
                <div class="panel-body">
                    <p class="text-muted">This is an example of muted text.</p>
                    <p class="text-primary">This is an example of primary text.</p>
                    <p class="text-success">This is an example of success text.</p>
                    <p class="text-info">This is an example of info text.</p>
                    <p class="text-warning">This is an example of warning text.</p>
                    <p class="text-danger">This is an example of danger text.</p>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Abbreviations
                </div>
                <div class="panel-body">
                    <p>The abbreviation of the word attribute is
                        <abbr title="attribute">attr</abbr>.
                    </p>
                    <p>
                        <abbr title="HyperText Markup Language" class="initialism">HTML</abbr>is an abbreviation for a programming language.
                    </p>
                    <br>
                    <h4>Addresses</h4>
                    <address>
                        <strong>Twitter, Inc.</strong>
                        <br>795 Folsom Ave, Suite 600
                        <br>San Francisco, CA 94107
                        <br>
                        <abbr title="Phone">P:</abbr>(123) 456-7890
                    </address>
                    <address>
                        <strong>Full Name</strong>
                        <br>
                        <a href="mailto:#">first.last@example.com</a>
                    </address>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Blockquotes
                </div>
                <div class="panel-body">
                    <h4>Default Blockquote</h4>
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </blockquote>
                    <h4>Blockquote with Citation</h4>
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <small>Someone famous in
                            <cite title="Source Title">Source Title</cite>
                        </small>
                    </blockquote>
                    <h4>Right Aligned Blockquote</h4>
                    <blockquote class="pull-right">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </blockquote>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lists
                </div>
                <div class="panel-body">
                    <h4>Unordered List</h4>
                    <ul>
                        <li>List Item</li>
                        <li>List Item</li>
                        <li>
                            <ul>
                                <li>List Item</li>
                                <li>List Item</li>
                                <li>List Item</li>
                            </ul>
                        </li>
                        <li>List Item</li>
                    </ul>
                    <h4>Ordered List</h4>
                    <ol>
                        <li>List Item</li>
                        <li>List Item</li>
                        <li>List Item</li>
                    </ol>
                    <h4>Unstyled List</h4>
                    <ul class="list-unstyled">
                        <li>List Item</li>
                        <li>List Item</li>
                        <li>List Item</li>
                    </ul>
                    <h4>Inline List</h4>
                    <ul class="list-inline">
                        <li>List Item</li>
                        <li>List Item</li>
                        <li>List Item</li>
                    </ul>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Description Lists
                </div>
                <div class="panel-body">
                    <dl>
                        <dt>Standard Description List</dt>
                        <dd>Description Text</dd>
                        <dt>Description List Title</dt>
                        <dd>Description List Text</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Horizontal Description List</dt>
                        <dd>Description Text</dd>
                        <dt>Description List Title</dt>
                        <dd>Description List Text</dd>
                    </dl>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Code
                </div>
                <div class="panel-body">
                    <p>This is an example of an inline code element within body copy. Wrap inline code within a
                        <code>&lt;code&gt;...&lt;/code&gt;</code>tag.
                    </p>
                    <pre>This is an example of preformatted text.</pre>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
@endsection