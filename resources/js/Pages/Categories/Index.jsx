import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { usePage } from "@inertiajs/react";
import { useState } from "react";
import Form from "./Form";
import TextInput from "@/Components/TextInput";
//import "../css/style.css";

export default function Index({auth}){

    const { categories } = usePage().props;
    const [searchCategory, setSearchCategory] = useState('');
    console.log(categories);

    const filteredCategory = categories.filter(
        category => category.name.toLocaleLowerCase().includes(searchCategory.toLocaleLowerCase())
    );
    return (

        <AuthenticatedLayout user={auth.user} header="CATEGORIAS">

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div>
                <div className="flex justify-between items-center pb-2">
                    <TextInput isFocused={true} type="text" name="search" placeholder="Buscar..." onChange={(event) => setSearchCategory(event.target.value)} />
                <Form/>
                </div>

            </div>
            <div>
                <table className="min-w-full">
                    <thead className="uppercase text-white">
                        <tr>
                            <th className="bg-gray-500 py-2">Categorias</th>
                            <th className="bg-gray-500 py-2">Descripcion</th>
                            <th className="bg-gray-500 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        { filteredCategory.map(category => (
                            <tr key={category.id} className=" hover: bg-gray-200">
                                <td className="py-2 px-3 border border-gray-300">{category.name}</td>
                                <td className="py-2 px-3 border border-gray-300">{category.description}</td>
                                <td className="py-2 px-3 border border-gray-300">
                                    <Form id={category.id} category={category}/>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
                        </div>
                    </div>
                </div>
            </div>


        </AuthenticatedLayout>
    )

}
