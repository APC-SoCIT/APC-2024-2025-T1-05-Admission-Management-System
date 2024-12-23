// resources/js/Components/DocumentViewer.jsx
import React, { useState } from 'react';
import { Dialog } from '@headlessui/react';
import { FileText, X } from 'lucide-react';

const DocumentViewer = ({ document }) => {
    const [isOpen, setIsOpen] = useState(false);

    return (
        <>
            <button
                onClick={() => setIsOpen(true)}
                className="inline-flex items-center gap-2 text-sm font-medium text-indigo-600 hover:text-indigo-900 transition-colors"
            >
                <FileText className="h-4 w-4" />
                View Document
            </button>

            <Dialog
                open={isOpen}
                onClose={() => setIsOpen(false)}
                className="relative z-50"
            >
                <div className="fixed inset-0 bg-black/30" aria-hidden="true" />

                <div className="fixed inset-0 flex w-screen items-center justify-center p-4">
                    <div className="mx-auto max-w-4xl w-full bg-white rounded-xl shadow-lg">
                        <div className="flex items-center justify-between p-4 border-b">
                            <h2 className="text-lg font-medium">
                                {document.document_type}
                            </h2>
                            <button
                                onClick={() => setIsOpen(false)}
                                className="text-gray-400 hover:text-gray-500 transition-colors"
                            >
                                <X className="h-5 w-5" />
                            </button>
                        </div>

                        <div className="p-4 h-[70vh] bg-gray-50">
                            <div className="w-full h-full rounded-lg overflow-hidden border border-gray-200 bg-white">
                                <iframe
                                    src={route('documents.view', document.id)}
                                    className="w-full h-full"
                                    title={document.document_type}
                                />
                            </div>
                        </div>

                        <div className="flex justify-end gap-2 p-4 border-t">
                            <button
                                onClick={() => window.open(document.file_path, '_blank')}
                                className="px-4 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-900"
                            >
                                Open in New Tab
                            </button>
                            <button
                                onClick={() => setIsOpen(false)}
                                className="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </Dialog>
        </>
    );
};

export default DocumentViewer;
