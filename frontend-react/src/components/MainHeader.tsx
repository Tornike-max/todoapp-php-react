import { Button, Select, SelectItem, useDisclosure } from "@nextui-org/react";
import { variants } from "../constants/constants";
import ModalComponent from "../ui/ModalComponent";

const MainHeader = () => {
  const { isOpen, onOpen, onOpenChange } = useDisclosure();
  return (
    <>
      <div className="w-full flex justify-between items-center bg-slate-200 rounded-2xl">
        <Select
          variant="bordered"
          color="primary"
          label="Select Variant"
          className="max-w-xs"
        >
          {variants.map((variant) => (
            <SelectItem key={variant.value} value={variant.value}>
              {variant.label}
            </SelectItem>
          ))}
        </Select>

        <Button onPress={onOpen} variant="bordered" color="primary" size="lg">
          Add A Task
        </Button>
      </div>
      {isOpen && <ModalComponent isOpen={isOpen} onOpenChange={onOpenChange} />}
    </>
  );
};

export default MainHeader;
