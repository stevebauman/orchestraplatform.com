<?php namespace App\Http\Controllers;

use App\Processor\Documentation as DocumentationProcessor;

class DocumentationController extends BaseController
{
    /**
     * Construct a new DocumentationController.
     *
     * @param  \App\Processor\Documentation  $processor
     */
    public function __construct(DocumentationProcessor $processor)
    {
        $this->processor = $processor;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function setupFilters()
    {
        //
    }

    /**
     * Show documentation.
     *
     * @Get("docs/{version}/{filename?}")
     * @Where({"version": "(.*)"})
     *
     * @param  string   $version
     * @param  string   $filename
     * @return mixed
     */
    public function show($version, $filename = 'index')
    {
        return $this->processor->show($this, $version, $filename);
    }

    /**
     * Display documentation.
     *
     * @param  string   $version
     * @param  string   $toc
     * @param  object   $document
     * @return mixed
     */
    public function showSucceed($version, $toc, $document)
    {
        set_meta('title', sprintf('%s on v%s', $document->get('title'), $version));

        return view('documentation', [
            'toc'      => $toc,
            'document' => $document,
            'version'  => $version,
            'html'     => [
                'toc'      => $this->processor->parseMarkdown($toc, $version),
                'document' => $this->processor->parseMarkdown($document, $version),
            ],
        ]);
    }
}
